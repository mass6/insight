<?php

use Cartalyst\Sentry\Users\Eloquent\User;
use Insight\Companies\CompanyRepository;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\AddNewProductDefinitionCommand;
use Insight\ProductDefinitions\Forms\DraftProductDefinitionForm;
use Insight\ProductDefinitions\Forms\NewProductDefinitionForm;
use Insight\ProductDefinitions\Forms\SupplierDraftProductDefinitionForm;
use Insight\ProductDefinitions\Forms\SupplierUpdateProductDefinitionForm;
use Insight\ProductDefinitions\Forms\UpdateLimitedProductDefinitionForm;
use Insight\ProductDefinitions\Forms\UpdateProductDefinitionForm;
use Insight\ProductDefinitions\ProductDefinitionRepository;
use Insight\ProductDefinitions\ProductDefinitionStatuses;
use Insight\ProductDefinitions\Attribute;
use Insight\ProductDefinitions\AttributeSet;
use Insight\ProductDefinitions\ProductImage;
use Insight\ProductDefinitions\UpdateLimitedProductDefinitionCommand;
use Insight\ProductDefinitions\UpdateProductDefinitionCommand;
use Laracasts\Utilities\JavaScript\Facades\JavaScript;

/**
 * Class ProductDefinitionsController
 */
class ProductDefinitionsController extends \BaseController {

    use CommandBus;

    /**
     * @var ProductDefinitionRepository
     */
    private $productDefinitionRepository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;
    /**
     * @var NewProductDefinitionForm
     */
    private $newProductDefinitionForm;
    /**
     * @var User
     */
    private $user;
    /**
     * @var UpdateProductDefinitionForm
     */
    private $updateProductDefinitionForm;
    /**
     * @var UpdateLimitedProductDefinitionForm
     */
    private $updateLimitedProductDefinitionForm;
    /**
     * @var DraftProductDefinitionForm
     */
    private $draftProductDefinitionForm;
    /**
     * @var SupplierDraftProductDefinitionForm
     */
    private $supplierDraftProductDefinitionForm;
    /**
     * @var SupplierUpdateProductDefinitionForm
     */
    private $supplierUpdateProductDefinitionForm;


    /**
     * @param ProductDefinitionRepository $productDefinitionRepository
     * @param CompanyRepository $companyRepository
     * @param NewProductDefinitionForm $newProductDefinitionForm
     * @param UpdateProductDefinitionForm $updateProductDefinitionForm
     * @param DraftProductDefinitionForm $draftProductDefinitionForm
     * @param SupplierDraftProductDefinitionForm $supplierDraftProductDefinitionForm
     * @param UpdateLimitedProductDefinitionForm $updateLimitedProductDefinitionForm
     * @param SupplierUpdateProductDefinitionForm $supplierUpdateProductDefinitionForm
     */
    public function __construct(
        ProductDefinitionRepository $productDefinitionRepository,
        CompanyRepository $companyRepository,
        NewProductDefinitionForm $newProductDefinitionForm,
        UpdateProductDefinitionForm $updateProductDefinitionForm,
        DraftProductDefinitionForm $draftProductDefinitionForm,
        SupplierDraftProductDefinitionForm $supplierDraftProductDefinitionForm,
        UpdateLimitedProductDefinitionForm $updateLimitedProductDefinitionForm,
        SupplierUpdateProductDefinitionForm $supplierUpdateProductDefinitionForm
    )
    {
        $this->beforeFilter(function()
        {
            if(! Sentry::getUser()->hasAccess('cataloguing.products.edit'))
                return Redirect::home();
        });

        $this->user = Sentry::getUser();
        $this->productDefinitionRepository = $productDefinitionRepository;
        $this->companyRepository = $companyRepository;
        $this->newProductDefinitionForm = $newProductDefinitionForm;
        $this->updateProductDefinitionForm = $updateProductDefinitionForm;
        $this->updateLimitedProductDefinitionForm = $updateLimitedProductDefinitionForm;
        $this->draftProductDefinitionForm = $draftProductDefinitionForm;
        $this->supplierDraftProductDefinitionForm = $supplierDraftProductDefinitionForm;
        $this->supplierUpdateProductDefinitionForm = $supplierUpdateProductDefinitionForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->user->hasAccess('cataloguing.products.admin')
            ? $this->productDefinitionRepository->getPaginated(10)
            : $this->productDefinitionRepository->getFilteredAndPaginated($this->user, 10);
        return View::make('product-definitions.index', compact('products'));
    }

    public function getQueue()
    {
        $products = $this->productDefinitionRepository->getUserQueue($this->user->id);

        return View::make('product-definitions.userqueue', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->user;
        $companies = $this->companyRepository->getCustomersList();
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($user->company);
        //$attributeSets = AttributeSet::with('attributes')->where('company_id', $user->company->id)->get();
        //$statuses =  ProductDefinitionStatuses::lists('name', 'id');
        //$assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($user->company);

        $customAttributes = false;
        if($user->company->settings()->getProductDefinitionTemplate)
        {
            $customAttributes = $user->company->settings()->ProductDefinitionTemplate;
        }

        return View::make('product-definitions.create', compact('user','companies','suppliers', 'customAttributes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $input['attributes'] = $this->parseAttributes($input);
        //$input['images'] = Input::file('images');
        $input['attachments'] = Input::file('attachments');

        if($input['action'] === 'save' || $input['action'] === 'assign-to-customer')
            $this->draftProductDefinitionForm->validate($input);
        elseif($input['action'] === 'assign-to-supplier')
            $this->supplierDraftProductDefinitionForm->validate($input);
        else
            $this->newProductDefinitionForm->validate($input);

        extract($input);
        $product = $this->execute(new AddNewProductDefinitionCommand(
            $this->user, $code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
            $attributes, $remarks, $supplier_id, $status, $action, $image1, $image2, $image3, $image4, $attachments
        ));

        Flash::success("Product {$product} was successfully created.");

        return Redirect::route('catalogue.product-definitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productDefinitionRepository->findWithComments($id);
        $attributes = object_to_array(json_decode($product->attributes));

        if($product->customer->settings()->getProductDefinitionTemplate)
        {
            $customAttributes = $product->customer->settings()->ProductDefinitionTemplate;
        }
        return View::make('product-definitions.show', compact('product', 'attributes', 'customAttributes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productDefinitionRepository->find($id);

        if($product->assigned_user_id !== $this->user->id && !$this->user->hasAccess('cataloguing.products.admin'))
        {
            Flash::error("Product is currently assigned to {$product->assignedTo->name()} and is locked for editing.");
            return Redirect::back();
        }


        $user = $this->user;
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($product->customer);
        // should be able to delete statuses variable below
        //$statuses =  ProductDefinitionStatuses::lists('name', 'id');

        //should be able to delete below variable
        //$assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($product->customer, $product->supplier);

        // pass attributes object to view as JS object
        if(! empty($product->attributes)){
            //return $product->attributes;
            //JavaScript::put(['attributes' => true]);
            JavaScript::put(['attributes' => object_to_array(json_decode($product->attributes))]);
        }
        else
            JavaScript::put(['attributes' => false]);

        $customAttributes = false;
        if($product->customer->settings()->getProductDefinitionTemplate)
        {
            $customAttributes = $product->customer->settings()->ProductDefinitionTemplate;
            JavaScript::put(['customAttributes' => true]);
        }
        $form = $this->user->hasAccess('cataloguing.products.edit.full') ? '_form-wizard-edit' : '_form-wizard-edit-limited';
        return View::make('product-definitions.edit', compact('product','user','suppliers', 'customAttributes', 'form'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $input = Input::all();
        $product = $this->productDefinitionRepository->find($id);
        $formType = $input['form-type'] === 'full' ? 'full' : 'limited';
        $input['existing_images'] = count($product->images) ? true : false;
        $input['attributes'] = $this->parseAttributes($input);
        //$input['images'] = Input::file('images');
        $input['attachments'] = Input::file('attachments');
        $input['remarks'] = $input['remarks'] . $input['message'];

        if($input['action'] === 'save' || $input['action'] === 'assign-to-customer')
            $this->draftProductDefinitionForm->validate($input);
        elseif($input['action'] === 'assign-to-supplier')
            $this->supplierDraftProductDefinitionForm->validate($input);
        elseif($formType === 'limited' && $input['action'] === 'submit')
            $this->supplierUpdateProductDefinitionForm->validate($input);
        else
            $this->supplierUpdateProductDefinitionForm->validate($input);
//        $input['form-type'] === 'full'
//            ? $this->updateProductDefinitionForm->validate($input)
//            : $this->updateLimitedProductDefinitionForm->validate($input);

        extract($input);

        $product = $this->execute(new UpdateProductDefinitionCommand(
            $this->user, $id, $code, $name, $user_id, $current_user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
            $attributes, $remarks, $supplier_id, $status, $action, $assigned_user_id, $assigned_by_id,  $image1, $image2, $image3, $image4, $attachments, $formType
        ));

//        $input['form-type'] === 'full'
//            ? $product = $this->execute(new UpdateProductDefinitionCommand(
//            $this->user, $id, $code, $name, $user_id, $current_user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
//            $attributes, $remarks, $supplier_id, $status, $action, $assigned_user_id, $assigned_by_id,  $image1, $image2, $image3, $image4, $attachments, $formType
//        ))
//            : $product = $this->execute(new UpdateLimitedProductDefinitionCommand(
//            $this->user, $id, $code, $name, $user_id, $current_user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
//            $attributes, $remarks, $supplier_id, $status, $action, $assigned_user_id, $assigned_by_id,  $image1, $image2, $image3, $image4, $attachments, 'limited'
//        ));

        Flash::success("Product ( {$product->code} : {$product->name} ) was successfully updated.");

        if($input['action'] === 'save')
            return Redirect::back();

        return Redirect::route('catalogue.product-definitions.index');

    }


    public function getCompleted()
    {
        $products = $this->user->hasAccess('cataloguing.products.admin')
            ? $this->productDefinitionRepository->findCompleted(10)
            : $this->productDefinitionRepository->findCompletedAndFiltered($this->user, 10);
        return View::make('product-definitions.completed', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param $customer_id
     * @return mixed
     */
    public function getSuppliers($customer_id)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($customer);
        return Response::json($suppliers);
    }

    /**
     * @param $customer_id
     * @param null $supplier_id
     * @return mixed
     */
    public function getAssignableSupplierUsers($customer_id, $supplier_id = null)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $supplier = $this->companyRepository->findById($supplier_id);
        $usersList = $this->productDefinitionRepository->getAssignableUsersList($customer, $supplier ? $supplier : null);

        return Response::json($usersList);
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getAssignableCustomerUsers($customer_id)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $usersList = $this->productDefinitionRepository->getAssignableUsersList($customer);

        return Response::json($usersList);
    }

    /**
     * Iterates through the Input array and parses out the dynamic attributes, adding them to new array.
     * Then, returns a new array with sub-arrays for each attribute name / value pair.
     * @param $input
     * @return array
     */
    private function parseAttributes($input)
    {
        $attributes = [];
        if(isset($attributes)){
            $attributeName = '';
            foreach($input as $field => $value)
            {
                if(substr($field,0,14) === 'attribute-name'){
                    $attributeName = $value; //substr($field,14,strlen($field)-14);
                    continue;
                }
                if(substr($field,0,15) === 'attribute-value'){
                    if($attributeName)
                        $attributes[$attributeName] = $value;
                }

            }
            return count($attributes) ? $attributes : null;
        }
    }


}
