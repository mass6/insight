<?php namespace Admin;

use Insight\Core\CommandBus;
use Insight\Companies\AddNewCompanyCommand;
use Insight\Companies\CompanyRepository;
use Insight\Companies\DeleteCompanyCommand;
use Insight\Companies\Forms\CompanyForm;
use Insight\Companies\UpdateCompanyCommand;
use Laracasts\Flash\Flash;
use View, Input, Redirect;

class CompaniesController extends AdminBaseController {

    use CommandBus;
    /**
     * @var CompanyRepository
     */
    private $company;
    /**
     * @var CompanyForm
     */
    private $companyForm;

    public function __construct(CompanyRepository $company, CompanyForm $companyForm)
    {
        $this->company = $company;
        $this->companyForm = $companyForm;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $companies = $this->company->getPaginated(10);

        return View::make('admin.companies.index', compact('companies'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin.companies.create');
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        extract(Input::only('name', 'type', 'notes'));

        $this->companyForm->validate(compact('name', 'type', 'notes'));

        $this->execute(new AddNewCompanyCommand($name, $type, $notes));

        Flash::message('Company was successfully created.');
        return Redirect::route('admin.companies.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = $this->company->findById($id);
        foreach($company->customers as $customer)
        {
            var_dump($customer->toArray());
        }
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $company = $this->company->findById($id);
        return View::make('admin.companies.edit', compact('company'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        extract(Input::only('name', 'type', 'notes'));
        $this->companyForm->validate(compact('id', 'name', 'type', 'notes'));
        $this->execute(new UpdateCompanyCommand($id, $name, $type, $notes));

        Flash::message('Company was successfully updated.');
        return Redirect::route('admin.companies.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $company = $this->company->findById($id);
        $this->execute(new DeleteCompanyCommand($company));

        Flash::message('Company was successfully deleted.');
        return Redirect::route('admin.companies.index');
	}


}
