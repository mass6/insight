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
        return ProductDefinition::with('customer')
            ->with('assignedTo')
            ->with('statusName')
            ->where('assigned_user_id', $id)
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
        return ProductDefinition::with('customer')
            ->with('supplier')
            ->with('assignedTo')
            ->with('statusName')
            ->where('status', '<>', "4")
            ->orderBy('created_at', 'desc')
            ->paginate($num);
    }

    public function getAllByCustomer($company_id)
    {
        return ProductDefinition::where('company_id', $company_id)->get();
    }

    public function getCompletedByCustomer($company_id)
    {
        return ProductDefinition::where('company_id', $company_id)
            ->where('status', '4')
            ->get();
    }

    public function findCompleted($num = 10)
    {
        return ProductDefinition::with('customer')
            ->with('assignedTo')
            ->with('supplier')
            ->with('statusName')
            ->where('status', '4')
            ->orderBy('updated_at', 'desc')->paginate($num);
    }

    public function findCompletedAndFiltered($user, $num = 10)
    {
        return ProductDefinition::with('customer')
            ->with('assignedTo')
            ->with('supplier')
            ->with('statusName')
            ->where('status', '4')
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
        return ProductDefinition::with('customer')
            ->with('assignedTo')
            ->with('supplier')
            ->with('statusName')
            ->where('status', '<>', "4")
            ->Where(function($query) use ($user)
            {
                $query->where('assigned_user_id', $user->id)
                    ->orWhere('user_id', $user->id)
                    ->orWhere('company_id', $user->company->id);
            })
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
            'short_description' => $product->short_description,
            'description' => $product->description,
            'image1' => $product->image1,
            'image2' => $product->image2,
            'image3' => $product->image3,
            'image4' => $product->image3,
            'attachment1' => $product->attachment1,
            'attachment2' => $product->attachment2,
            'attachment3' => $product->attachment3,
            'attachment4' => $product->attachment4,
            'attachment5' => $product->attachment5,
            'attributes' => $product->attributes,
            'remarks' => $product->remarks,
            'supplier_id' => ! empty($product->supplier_id) ? $product->supplier_id: null,
            'assigned_user_id' => $product->user_id,
            'assigned_by_id' => $product->user_id,
            'updated_by_id' => $product->user_id,
            'status' => $product->status,
        ]);
        return $newProduct;

    }

    /**
     * Used to update product when used with full edit web form
     *
     * @param ProductDefinition $productToUpdate
     * @param UpdateProductDefinitionCommand $command
     * @return mixed
     */
    public function update(ProductDefinition $productToUpdate, UpdateProductDefinitionCommand $command)
    {
        $productToUpdate->supplier_id = ! empty($command->supplier_id) ? $command->supplier_id: null;
        $productToUpdate->code = $command->code;
        $productToUpdate->name = $command->name;
        $productToUpdate->category = $command->category;
        $productToUpdate->uom = $command->uom;
        $productToUpdate->price = $command->price;
        $productToUpdate->currency = $command->currency;
        $productToUpdate->short_description = $command->short_description;
        $productToUpdate->description = $command->description;
        if (!empty($command->image1))
            $productToUpdate->image1 = $command->image1;
        if (!empty($command->image2))
            $productToUpdate->image2 = $command->image2;
        if (!empty($command->image3))
            $productToUpdate->image3 = $command->image3;
        if (!empty($command->image4))
            $productToUpdate->image4 = $command->image4;
        if (!empty($command->attachment1))
            $productToUpdate->attachment1 = $command->attachment1;
        if (!empty($command->attachment2))
            $productToUpdate->attachment2 = $command->attachment2;
        if (!empty($command->attachment3))
            $productToUpdate->attachment3 = $command->attachment3;
        if (!empty($command->attachment4))
            $productToUpdate->attachment4 = $command->attachment4;
        if (!empty($command->attachment5))
            $productToUpdate->attachment5 = $command->attachment5;
        $productToUpdate->attributes = $command->attributes;
        $productToUpdate->remarks = $command->remarks;
        $productToUpdate->status = $command->status;
        $productToUpdate->updated_by_id = $command->user->id;

        $productToUpdate->save();
        return $productToUpdate;

    }

    /**
     * Used to update product attributes, specifically
     *
     * @param $id
     * @param $attributes
     * @internal param UpdateProductDefinitionCommand $command
     * @return mixed
     */
    public function updateAttributes($id, $attributes)
    {
        $productToUpdate = $this->find($id);
        $productToUpdate->attributes = $attributes;
        $productToUpdate->save();
        return $productToUpdate;

    }

    /**
     * Used to update product when used with the limited-edit web form
     *
     * @param UpdateProductDefinitionCommand $command
     * @return mixed
     */
    public function updateLimited(UpdateProductDefinitionCommand $command)
    {
        $productToUpdate = $this->find($command->id);

        $productToUpdate->description = $command->description;
        $productToUpdate->short_description = $command->short_description;
        $productToUpdate->attributes = $command->attributes;
        $productToUpdate->remarks = $command->remarks;
        $productToUpdate->updated_by_id = $command->current_user_id;
        if($command->action !== 'save'){
            $productToUpdate->assigned_user_id = $command->assigned_user_id;
            $productToUpdate->assigned_by_id = $command->current_user_id;
        }
        $productToUpdate->status = $command->status;

        $productToUpdate->save();

        return $productToUpdate;

    }

} 