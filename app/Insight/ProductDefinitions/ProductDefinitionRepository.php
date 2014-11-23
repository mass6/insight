<?php namespace Insight\ProductDefinitions;
use Insight\Companies\Company;
use Insight\Mailers\ProductDefinitionsMailer;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 11/5/14
 * Time: 11:33 AM
 */

/**
 * Class ProductDefinitionRepository
 * @package Insight\ProductDefinitions
 */
class ProductDefinitionRepository
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        return ProductDefinition::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return ProductDefinition::findOrFail($id);
    }

    public function getUserQueue($id)
    {
        return ProductDefinition::where('assigned_user_id', $id)
            ->whereNotIn('status', [4, 5, 6])
            ->paginate(10);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function findWithComments($id)
    {
        return ProductDefinition::with('comments')->find($id);
    }

    /**
     * @param int $num
     * @return mixed
     */
    public function getPaginated($num = 10)
    {
        return ProductDefinition::orderBy('created_at', 'desc')->paginate($num);
    }

    public function findCompleted($num = 10)
    {
        return ProductDefinition::where('status', '4')->orderBy('updated_at', 'desc')->paginate($num);
    }

    public function findCompletedAndFiltered($user, $num = 10)
    {
        return ProductDefinition::where('status', '4')
            ->Where(function($query) use ($user)
            {
                $query->where('user_id', $user->id)
                    ->orWhere('company_id', $user->company->id);
            })
            ->orderBy('updated_at', 'desc')->paginate($num);
    }

    /**
     * @param $user
     * @param int $num
     * @return mixed
     */
    public function getFilteredAndPaginated($user, $num = 10)
    {
        return ProductDefinition::where('assigned_user_id', $user->id)
            ->orWhere('user_id', $user->id)
            ->orWhere('company_id', $user->company->id)
            ->orderBy('created_at', 'desc')->paginate($num);
        //return ProductDefinition::orderBy('created_at', 'desc')->paginate($num);
    }

    /**
     * @param $customer
     * @param null $supplier
     * @return array
     */
    public function getAssignableUsersList($customer, $supplier = null)
    {

        // get all other users from the users's own company
        $customerUsers = $customer->users;

        // get 36S users
        $thirtySixStrat = Company::where('name', '36s')->first();
        $thirtySixStratUsers = $thirtySixStrat->users;


        // create array formatted for Select input
        $usersList = [];

        // User's Company Group
        foreach($customerUsers as $user)
        {
            $usersList[$customer->name][$user->id] = $user->name();
        }
        if($customer->name !=='36s') {
            foreach ($thirtySixStratUsers as $user) {
                if($user->hasAccess('cataloguing.products.admin')){
                    $usersList['36S'][$user->id] = $user->name();
                }
            }
        }
        // if supplier if provided, add users to usersList array
        if (isset($supplier))
        {
            if($supplier->name !=='36s'){
                // get all users from the supplier
                $supplierUsers = $supplier->users;

                foreach($supplierUsers as $user)
                {
                    $usersList[$supplier->name][$user->id] = $user->name();
                }
            }
        }

        return $usersList;
    }

    /**
     * @param AddNewProductDefinitionCommand $product
     * @return mixed
     */
    public function create(AddNewProductDefinitionCommand $product)
    {
        $newProduct = ProductDefinition::create([
            'user_id' => $product->user_id,
            'company_id' => $product->company_id,
            'code' => $product->code,
            'name' => $product->name,
            'category' => $product->category,
            'uom' => $product->uom,
            'price' => $product->price,
            'currency' => $product->currency,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'attributes' => $product->attributes,
            'remarks' => $product->remarks,
            'supplier_id' => ! empty($product->supplier_id) ? $product->supplier_id: null,
            'assigned_user_id' => $product->assigned_user_id,
            'assigned_by_id' => $product->user_id,
            'updated_by_id' => $product->user_id,
            'status' => $product->status,
        ]);
        return $newProduct;

    }

    /**
     * Used to update product when used with full edit web form
     *
     * @param UpdateProductDefinitionCommand $command
     * @return mixed
     */
    public function update(UpdateProductDefinitionCommand $command)
    {
        $productToUpdate = $this->find($command->id);

        $productToUpdate->code = $command->code;
        $productToUpdate->name = $command->name;
        $productToUpdate->category = $command->category;
        $productToUpdate->uom = $command->uom;
        $productToUpdate->price = $command->price;
        $productToUpdate->currency = $command->currency;
        $productToUpdate->description = $command->description;
        $productToUpdate->short_description = $command->short_description;
        $productToUpdate->attributes = $command->attributes;
        $productToUpdate->remarks = $command->remarks;
        $productToUpdate->supplier_id = ! empty($command->supplier_id) ? $command->supplier_id: null;
        $productToUpdate->updated_by_id = $command->current_user_id;
        if($command->action !== 'save'){
            $productToUpdate->assigned_user_id = $command->assigned_user_id;
            $productToUpdate->assigned_by_id = $command->current_user_id;
        }
        $productToUpdate->status = $command->status;

        $productToUpdate->save();

        return $productToUpdate;

    }

    /**
     * Used to update product when used with the limited-edit web form
     *
     * @param UpdateLimitedProductDefinitionCommand $product
     * @return mixed
     */
    public function updateLimited(UpdateLimitedProductDefinitionCommand $product)
    {
        $productToUpdate = $this->find($product->id);
        $productToUpdate->description = $product->description;
        $productToUpdate->short_description = $product->short_description;
        $productToUpdate->attributes = $product->attributes;
        $productToUpdate->remarks = $product->remarks;
        $productToUpdate->assigned_user_id = $product->assigned_user_id;
        $productToUpdate->status = $product->status;

        $productToUpdate->save();

        return $productToUpdate;

    }

} 