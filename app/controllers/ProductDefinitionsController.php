<?php

use Cartalyst\Sentry\Users\Eloquent\User;
use Insight\Companies\CompanyRepository;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\AddNewProductDefinitionCommand;
use Insight\ProductDefinitions\Forms\DraftProductDefinitionForm;
use Insight\ProductDefinitions\Forms\NewProductDefinitionForm;
use Insight\ProductDefinitions\Forms\ProductDefinitionFormFactory;
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
use Insight\ProductDefinitions\FormatRequestDataForDownloadCommand;
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
    //private $user;
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
     * @var ProductDefinitionFormFactory
     */
    private $productDefinitionFormFactory;


    /**
     * @param ProductDefinitionRepository $productDefinitionRepository
     * @param CompanyRepository $companyRepository
     * @param ProductDefinitionFormFactory $productDefinitionFormFactory
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
        ProductDefinitionFormFactory $productDefinitionFormFactory,
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

        //$this->user = Sentry::getUser();
        $this->productDefinitionRepository = $productDefinitionRepository;
        $this->companyRepository = $companyRepository;
        $this->newProductDefinitionForm = $newProductDefinitionForm;
        $this->updateProductDefinitionForm = $updateProductDefinitionForm;
        $this->updateLimitedProductDefinitionForm = $updateLimitedProductDefinitionForm;
        $this->draftProductDefinitionForm = $draftProductDefinitionForm;
        $this->supplierDraftProductDefinitionForm = $supplierDraftProductDefinitionForm;
        $this->supplierUpdateProductDefinitionForm = $supplierUpdateProductDefinitionForm;

        parent::__construct();
        $this->productDefinitionFormFactory = $productDefinitionFormFactory;
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
        $company_id = Request::get('company_id');
        $company = $this->companyRepository->findById(Request::get('company_id', $this->user->company->id));

        $companies = $this->companyRepository->getCustomersList();
        $suppliers = $this->companyRepository->getAssociatedSuppliersList($company);

        $customAttributes = false;
        if($company->settings()->getProductDefinitionTemplate)
        {
            $customAttributes = $company->settings()->ProductDefinitionTemplate;
        }

        return View::make('product-definitions.create', compact('company_id', 'company', 'companies','suppliers', 'customAttributes'));
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
        //$input['attachments'] = Input::file('attachments');

        $validationForm = $this->productDefinitionFormFactory->make($input['action'],$this->user, $this->company);
        $validationForm->validate($input);
//        if($input['action'] === 'save' || $input['action'] === 'assign-to-customer')
//            $this->draftProductDefinitionForm->validate($input);
//        elseif($input['action'] === 'assign-to-supplier')
//            $this->supplierDraftProductDefinitionForm->validate($input);
//        else
//            $this->newProductDefinitionForm->validate($input);

        // temporary test


        extract($input);
        $product = $this->execute(new AddNewProductDefinitionCommand(
            $this->user, $code, $name, $this->user->id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
            $attributes, $remarks, $supplier_id, $action, $image1, $image2, $image3, $image4, $attachment1, $attachment2, $attachment3, $attachment4, $attachment5
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

        $customAttributes = false;
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
        // parse the attributes from the form into an array
        $input['attributes'] = $this->parseAttributes($input);

        //
        $input['existingImage1'] = $product->image1->originalFilename() ? $product->image1 : null ;
        $input['existingImage2'] = $product->image2->originalFilename() ? $product->image2 : null ;
        $input['existingImage3'] = $product->image3->originalFilename() ? $product->image3 : null ;
        $input['existingImage4'] = $product->image4->originalFilename() ? $product->image4 : null ;
        $input['existingAttachment1'] = $product->attachment1->originalFilename() ? $product->attachment1 : null ;
        $input['existingAttachment2'] = $product->attachment2->originalFilename() ? $product->attachment2 : null ;
        $input['existingAttachment3'] = $product->attachment3->originalFilename() ? $product->attachment3 : null ;
        $input['existingAttachment4'] = $product->attachment4->originalFilename() ? $product->attachment4 : null ;
        $input['existingAttachment5'] = $product->attachment5->originalFilename() ? $product->attachment5 : null ;

        $validationForm = $this->productDefinitionFormFactory->make($input['action'], $this->user, $product->customer);
        //return get_class($validationForm);
        $validationForm->validate($input);

        extract($input);

        $product = $this->execute(new UpdateProductDefinitionCommand(
            $this->user, $product, $product->company_id, $supplier_id, $code, $name, $category, $uom, $price, $currency, $short_description, $description,
            $image1, $image2, $image3, $image4, $attachment1, $attachment2, $attachment3, $attachment4, $attachment5, $attributes, Input::get('form-type', 'limited'), $remarks, $action
        ));


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

    public function export()
    {
        return View::make('product-definitions.export');
    }

    public function download($filter = 'all', $format = 'csv')
    {
        $customerId = $this->user->company->id;
        $data = $this->execute(new FormatRequestDataForDownloadCommand($filter, $format, $customerId));


        //return $data;
        $sheetName = ucfirst($filter) . 'ProductRequests';


        Excel::create($sheetName . '_' . date('Ymd_g:i:s'), function($excel) use($data, $sheetName) {

            $excel->sheet($sheetName, function($sheet) use($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

            });


        })->export($format);

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

    public function detachImage($productDefinitionId, $image)
    {
        $product = $this->productDefinitionRepository->find($productDefinitionId);
        $name = $product->{$image}->originalFilename();
        $product->{$image} = STAPLER_NULL;
        $product->save();
        return Response::json(['name' => $name]);
    }

    public function detachAttachment($productDefinitionId, $attachment)
    {
        $product = $this->productDefinitionRepository->find($productDefinitionId);
        $name = $product->{$attachment}->originalFilename();
        $product->{$attachment} = STAPLER_NULL;
        $product->save();
        return Response::json(['name' => $name]);
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
//    private function parseAttributes($input)
//    {
//        $attributes = [];
//        if(isset($attributes)){
//            $attributeName = '';
//            foreach($input as $field => $value)
//            {
//                if(substr($field,0,14) === 'attribute-name'){
//                    $attributeName = $value; //substr($field,14,strlen($field)-14);
//                    continue;
//                }
//                if(substr($field,0,15) === 'attribute-value'){
//                    if($attributeName)
//                        $attributes[$attributeName] = $value;
//                }
//
//            }
//            return count($attributes) ? $attributes : null;
//        }
//    }
    private function parseAttributes($input)
    {
        $attributes = [];
        if(isset($attributes)){
            $attributeName = '';
            foreach($input as $field => $value)
            {
//                if(substr($field,0,14) === 'attribute-name'){
//                    $attributeName = $value; //substr($field,14,strlen($field)-14);
//                    continue;
//                }
                if(substr($field,0,15) === 'attribute-value'){
                        $attributes[$input['attribute-name-' . substr($field,16)]] = $value;
                }

            }
            return count($attributes) ? $attributes : null;
        }
    }


}
