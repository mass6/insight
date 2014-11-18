<?php

use Cartalyst\Sentry\Users\Eloquent\User;
use Insight\Companies\CompanyRepository;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\AddNewProductDefinitionCommand;
use Insight\ProductDefinitions\Forms\NewProductDefinitionForm;
use Insight\ProductDefinitions\Forms\UpdateLimitedProductDefinitionForm;
use Insight\ProductDefinitions\Forms\UpdateProductDefinitionForm;
use Insight\ProductDefinitions\ProductDefinitionRepository;
use Insight\ProductDefinitions\ProductDefinitionStatuses;
use Insight\ProductDefinitions\Attribute;
use Insight\ProductDefinitions\AttributeSet;
use Insight\ProductDefinitions\ProductImage;
use Insight\ProductDefinitions\UpdateLimitedProductDefinitionCommand;
use Insight\ProductDefinitions\UpdateProductDefinitionCommand;

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

    private $isInternalUser;
    /**
     * @var UpdateProductDefinitionForm
     */
    private $updateProductDefinitionForm;
    /**
     * @var UpdateLimitedProductDefinitionForm
     */
    private $updateLimitedProductDefinitionForm;

    public function __construct(ProductDefinitionRepository $productDefinitionRepository, CompanyRepository $companyRepository,
                                NewProductDefinitionForm $newProductDefinitionForm, UpdateProductDefinitionForm $updateProductDefinitionForm,
                                UpdateLimitedProductDefinitionForm $updateLimitedProductDefinitionForm)
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
        $this->isInternalUser = $this->isInternal($this->user);
        $this->updateProductDefinitionForm = $updateProductDefinitionForm;
        $this->updateLimitedProductDefinitionForm = $updateLimitedProductDefinitionForm;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->isInternalUser
            ? $this->productDefinitionRepository->getPaginated(5)
            : $this->productDefinitionRepository->getFilteredAndPaginated($this->user, 5);
        return View::make('product-definitions.index', compact('products'));
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $user = $this->user;
        $internalUser = $this->isInternalUser;
        $companies = $this->companyRepository->getCustomersList();
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($user->company);
        $attributeSets = AttributeSet::with('attributes')->where('company_id', $user->company->id)->get();
        $statuses =  ProductDefinitionStatuses::lists('name', 'id');
        $assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($user->company);
        return View::make('product-definitions.create', compact('user','companies','suppliers', 'statuses', 'assignableUsersList', 'internalUser'));
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::all();
        $input['images'] = Input::file('images');
        $input['attachments'] = Input::file('attachments');

        $this->newProductDefinitionForm->validate($input);

        extract($input);
        $product = $this->execute(new AddNewProductDefinitionCommand(
            $code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
            $attributes, $remarks, $supplier_id, $assigned_user_id, $status, $images, $attachments
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
		$product = $this->productDefinitionRepository->find($id);

        return View::make('product-definitions.show', compact('product'));
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
        $user = $this->user;
        $supplier = $product->supplier;
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($product->customer);
        $statuses =  ProductDefinitionStatuses::lists('name', 'id');
        $assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($product->customer, $supplier);
        $form = $this->user->hasAccess('cataloguing.products.edit.full') ? '_form-edit' : '_form-edit-limited';
        return View::make('product-definitions.edit', compact('product','user','supplier','suppliers','statuses', 'assignableUsersList', 'form'));
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
        $input['images'] = Input::file('images');
        $input['attachments'] = Input::file('attachments');

        $input['form-type'] === 'full'
        ? $this->updateProductDefinitionForm->validate($input)
        : $this->updateLimitedProductDefinitionForm->validate($input);

        extract($input);

        $input['form-type'] === 'full'
        ? $product = $this->execute(new UpdateProductDefinitionCommand(
            $id, $code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
            $attributes, $remarks, $supplier_id, $assigned_user_id, $status, $images, $attachments, 'full'
        ))
        : $product = $this->execute(new UpdateLimitedProductDefinitionCommand(
            $id, $user_id, $description, $short_description, $attributes, $remarks,
            $assigned_user_id, $status, $images, $attachments, 'limited'
        ));

        Flash::success("Product {$product->name} was successfully updated.");

        return Redirect::route('catalogue.product-definitions.index');
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

    private function isInternal($user)
    {
        return $user->hasAccess('cataloguing.products.edit.limited') ? true : false;
    }
    public function getSuppliers($customer_id)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($customer);
        return Response::json($suppliers);
    }
    public function getAssignableSupplierUsers($customer_id, $supplier_id = null)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $supplier = $this->companyRepository->findById($supplier_id);
        $usersList = $this->productDefinitionRepository->getAssignableUsersList($customer, $supplier ? $supplier : null);

        return Response::json($usersList);
    }
    public function getAssignableCustomerUsers($customer_id)
    {
        $customer = $this->companyRepository->findById($customer_id);
        $usersList = $this->productDefinitionRepository->getAssignableUsersList($customer);

        return Response::json($usersList);
    }


}
