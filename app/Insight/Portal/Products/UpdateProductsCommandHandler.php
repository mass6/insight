<?php namespace Insight\Portal\Products;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Commander\Events\DispatchableTrait;
use Insight\Portal\Products\Events\ProductsWereUpdated;
use \Log;
/**
 * Insight Client Management Portal:
 * Date: 8/10/14
 * Time: 3:24 PM
 */

class UpdateProductsCommandHandler implements CommandHandler
{
    use EventGenerator, DispatchableTrait;

    /**
     * @var ProductRepository
     */
    private $product;

    public $changeLog;

    public function __construct()
{
    $this->product = new ProductRepository;
}

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $added = 0;
        $deleted = 0;
        $updated = 0;

        $local = $command->localProducts;

        // remove the 'id' field from local products array for sake of comparison
        $localProducts = [];
        foreach ($local as $product)
        {
            unset($product['id']);
            $product['entity'] = (string)$product['entity_id'];
            $localProducts[] = $product;
        }
        $portalProducts = $command->portalProducts;

        // get local entity_id's for comparison
        $localIds = [];
        foreach ($localProducts as $product){
            $localIds[] = $product['entity_id'];
        }
        $portalIds = [];
        foreach ($portalProducts as $product){
            $portalIds[] = $product['entity_id'];
        }
//        Log::info($localIds);
//        Log::info($portalIds);

        // Add products
        $toBeAddedIds = array_diff($portalIds, $localIds);

        $numToBeAdded = count($toBeAddedIds);
        $productsToBeAdded = [];

        foreach ($portalProducts as $product)
        {
            if ( in_array($product['entity_id'], $toBeAddedIds)){
                $productsToBeAdded[] = $product;
            }
        }
        //Log::info($productsToBeAdded);
        $added = $this->addProducts($productsToBeAdded);

        // Delete Products
        $toBeDeletedIds = array_diff($localIds, $portalIds);
        $numToBeDeleted = count($toBeDeletedIds);
        $productsToBeDeleted = [];
        foreach ($localProducts as $product)
        {
            if ( in_array($product['entity_id'], $toBeDeletedIds)){
                $productsToBeDeleted[] = $product;
            }
        }
        //Log::info($productsToBeDeleted);
        $deleted = $this->deleteProducts($productsToBeDeleted);

        // Verify Products
        $toBeVerifiedIds = array_intersect($localIds,$portalIds);
        $numToBeVerified = count($toBeVerifiedIds);
        //Log::info($toBeVerifiedIds);


        $localProducts = $this->productsToCompare($localProducts, $toBeVerifiedIds);
        $portalProducts = $this->productsToCompare($portalProducts, $toBeVerifiedIds);
        $productUpdates = $this->compareProducts($localProducts, $portalProducts);
        $numToBeUpdated = count($productUpdates);
        // process the product changes required
        if ($productUpdates){
            $updated = $this->updateProducts($productUpdates);
        }

        if ($this->changeLog){
            Log::info($this->changeLog);
            $this->raise(new ProductsWereUpdated($this->changeLog));
            $this->dispatchEventsFor($this);

        } else {
            Log::info("All products up to date. No changes to be made.");
        }

        return "To be updated: {$numToBeUpdated}  To be added: {$numToBeAdded}  To be deleted: {$numToBeDeleted} \r\n
         Actual updated: {$updated}  Actual added: {$added}  Actual deleted: {$deleted} ";



    }

    public function addProducts($products)
    {
        $added = 0;
        foreach ($products as $product)
        {
            $newProduct = $this->product->addProduct($product);
            if ($newProduct){
                $added++;
                $this->changeLog[$product['customer']]['Added Products'][] = $product['sku'] . '(' . $product['bp_product_code'] . ') - ' . $product['name'];
            }
        }
        return $added;
    }

    public function deleteProducts($products)
    {
        $deleted = 0;
        foreach ($products as $product)
        {
            $deletedProduct = $this->product->deleteProduct($product);
            if ($deletedProduct){
                $deleted++;
                $this->changeLog[$product['customer']]['Deleted Products'][] = $product['sku'] . '(' . $product['bp_product_code'] . ') - ' . $product['name'];
            }
        }
        return $deleted;
    }

    public function productsToCompare($products, $ids )
    {
        $array = [];
        foreach ($products as $product)
        {
            if (in_array($product['entity_id'], $ids)){
                $array[$product['entity_id']] = $product;
            }
        }
        asort($array);
        return $array;
    }

    public function compareProducts($localProducts, $portalProducts)
    {
        $changes = false;

        $productUpdates = [];
        foreach ($localProducts as $product)
        {
            $portalProduct = $portalProducts[$product['entity_id']];

            $columnUpdates = [];
            $i = 0;
            // Begin column comparison
            foreach ($portalProduct as $key => $val)
            {
                if ($val != $product[$key]){
                    $differences = ucwords($key) . ' changed from "' . $product[$key] . '" to "' . $val . '"';
                    $columnUpdates[$i]['entity_id'] = $portalProduct['entity_id'];
                    $columnUpdates[$i]['sku'] = $portalProduct['sku'];
                    $columnUpdates[$i]['bp_product_code'] = $portalProduct['bp_product_code'];
                    $columnUpdates[$i]['name'] = $portalProduct['name'];
                    $columnUpdates[$i]['column'] = $key;
                    $columnUpdates[$i]['value'] = $val;
                    $columnUpdates[$i]['description'] = $differences;
                    $columnUpdates[$i]['customer'] = $portalProduct['customer'];

                    $i++;
                    $changes = true;
                }
                //$differences[] = 'Comparing ' . $key . ' = ' . $val . ' with ' . $product[$key];
            }
            if ($columnUpdates)
                $productUpdates[$product['entity_id']] = $columnUpdates;
            //$productUpdates[$product['entity_id']]['descriptions'] = $differences;
        }
        // Updates to be made
        //Log::info($productUpdates);

        return $productUpdates;

    }

    public function updateProducts($productUpdates)
    {
        $updated = 0;
        foreach ($productUpdates as $entityId => $columnUpdates)
        {
            //Log::info($columnUpdates);
            $updates = $this->product->updateColumns($entityId, $columnUpdates);
            if ($updates)
            {
                $this->changeLog[$columnUpdates[0]['customer']]['Updated Products'][$columnUpdates[0]['sku']
                . '(' . $columnUpdates[0]['bp_product_code'] . ') - ' . $columnUpdates[0]['name']] = $updates;
                $updated++;
            }
            //Log::info($product);
            //Log::info($columnUpdates);
        }
        return $updated;
    }
}