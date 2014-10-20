<?php namespace Insight\Portal\Products;
/**
 * Insight Client Management Portal:
 * Date: 8/13/14
 * Time: 10:02 AM
 */
class ProductRepository
{

    public function getAll()
    {
        return Product::all();
    }

    public function getCustomerProducts($customer)
    {
        return Product::where('store', (int) $customer['store'])->get();
    }

    public function addProduct($product)
    {
        return Product::create($product);
    }

    public function deleteProduct($productId)
    {
        $product = Product::where('entity_id', $productId['entity_id'])->first();
        if ($product)
        {
            return $product->delete();
        }
    }

    public function updateColumns($id, $columnUpdates)
    {
        $products = Product::where('entity_id', $id)->get();

        if ($products)
        {
            foreach ($products as $product)
            {
                $changes = [];
                foreach ($columnUpdates as $update)
                {
                    $product->$update['column'] = $update['value'];
                    $changes[] = $update['description'];
                }
                if ($product->save()) {
                    return $changes;
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }


    }

} 