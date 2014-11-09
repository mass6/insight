<?php

use Cartalyst\Sentry\Users\Eloquent\User;
use Insight\Companies\CompanyRepository;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\AddNewProductDefinitionCommand;
use Insight\ProductDefinitions\Forms\NewProductDefinitionForm;
use Insight\ProductDefinitions\ProductDefinitionRepository;
use Insight\ProductDefinitions\ProductDefinitionStatuses;

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

    public function __construct(ProductDefinitionRepository $productDefinitionRepository, CompanyRepository $companyRepository,
                                NewProductDefinitionForm $newProductDefinitionForm)
    {
        $this->productDefinitionRepository = $productDefinitionRepository;
        $this->companyRepository = $companyRepository;
        $this->newProductDefinitionForm = $newProductDefinitionForm;
        $this->user = Sentry::getUser();
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->productDefinitionRepository->getPaginated(5);
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
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($user->company);
        $statuses =  ProductDefinitionStatuses::lists('name', 'id');
        $assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($user->company);
        return View::make('product-definitions.create', compact('user','suppliers', 'statuses', 'assignableUsersList'));
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
            $code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description,
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
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($user->company);
        $statuses =  ProductDefinitionStatuses::lists('name', 'id');
        $assignableUsersList = $this->productDefinitionRepository->getAssignableUsersList($user->company);
        return View::make('product-definitions.edit', compact('product','user','suppliers', 'statuses', 'assignableUsersList'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

    public function getAssignableUsers($supplier_id)
    {
        $supplier = $this->companyRepository->findById($supplier_id);
        $usersList = $this->productDefinitionRepository->getAssignableUsersList($this->user->company, $supplier);

        return Response::json($usersList);
    }


}
