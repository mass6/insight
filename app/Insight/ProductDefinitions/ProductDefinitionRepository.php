<?php namespace Insight\ProductDefinitions;
use Insight\Companies\Company;
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

    public function find($id)
    {
        return ProductDefinition::findOrFail($id);
    }

    public function getPaginated($num = 10)
    {
        return ProductDefinition::orderBy('created_at', 'desc')->paginate($num);
    }

    public function getAssignableUsersList($customer, $supplier = null)
    {

        // get all other users from the users's own company
        $customerUsers = $customer->users;



        // get 36S users
        $thirtySixStrat = Company::where('name', '36s')->first();
        $thirtySixStratUsers = $thirtySixStrat->users;


        // create array formatted for Select input
        $usersList = [];
        foreach($customerUsers as $user)
        {
            $usersList[$user->id] = $user->name();
        }
        foreach($thirtySixStratUsers as $user)
        {
            $usersList[$user->id] = $user->name();
        }

        // if supplier if provided, add users to usersList array
        if (isset($supplier))
        {
            // get all users from the supplier
            $supplierUsers = $supplier->users;

            foreach($supplierUsers as $user)
            {
                $usersList[$user->id] = $user->name();
            }
        }
//
//
//        $customer = $company->users;
//        $usersList = [];
//        foreach($users as $user)
//        {
//            $usersList[$user->id] = $user->name();
//        }
        return $usersList;
    }

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
            'attributes' => $product->attributes,
            'remarks' => $product->remarks,
            'supplier_id' => ! empty($product->supplier_id) ? $product->supplier_id: null,
            'assigned_user_id' => $product->assigned_user_id,
            'status' => $product->status,
        ]);
        return $newProduct;

    }


} 