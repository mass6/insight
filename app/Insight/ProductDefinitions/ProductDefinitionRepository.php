<?php namespace Insight\ProductDefinitions;
use Insight\Companies\Company;
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

    /**
     * @param int $num
     * @return mixed
     */
    public function getPaginated($num = 10)
    {
        return ProductDefinition::orderBy('created_at', 'desc')->paginate($num);
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
            'short_description' => $product->description,
            'attributes' => $product->attributes,
            'remarks' => $product->remarks,
            'supplier_id' => ! empty($product->supplier_id) ? $product->supplier_id: null,
            'assigned_user_id' => $product->assigned_user_id,
            'status' => $product->status,
        ]);
        return $newProduct;

    }

    /**
     * Used to update product when used with full edit web form
     *
     * @param UpdateProductDefinitionCommand $product
     * @return mixed
     */
    public function update(UpdateProductDefinitionCommand $product)
    {
        $productToUpdate = $this->find($product->id);

        $productToUpdate->code = $product->code;
        $productToUpdate->name = $product->name;
        $productToUpdate->category = $product->category;
        $productToUpdate->uom = $product->uom;
        $productToUpdate->price = $product->price;
        $productToUpdate->currency = $product->currency;
        $productToUpdate->description = $product->description;
        $productToUpdate->short_description = $product->short_description;
        $productToUpdate->attributes = $product->attributes;
        $productToUpdate->remarks = $product->remarks;
        $productToUpdate->supplier_id = ! empty($product->supplier_id) ? $product->supplier_id: null;
        $productToUpdate->assigned_user_id = $product->assigned_user_id;
        $productToUpdate->status = $product->status;

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