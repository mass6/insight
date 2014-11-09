<?php namespace Insight\Companies;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 2:20 PM
 */


class CompanyRepository
{
    public function getAll()
    {
        return Company::all();
    }

    public function findById($id)
    {
        return Company::find($id);
    }

    public function getPaginated($num = 10)
    {
        return Company::paginate($num);
    }

    public function getList()
    {
        return Company::lists('name', 'id');
    }

    public function create(Array $company)
    {
        $newCompany = Company::create([
            'name'  => $company['name'],
            'type'  => $company['type'],
            'notes'  => $company['notes']
        ]);

        return $newCompany;

    }

    public function getAssociatedSuppliersList($company)
    {
        return ['' => '[Select]'] + $company->suppliers->lists('name', 'id');

    }

    public function delete($id)
    {
        Company::destroy($id);
    }

} 