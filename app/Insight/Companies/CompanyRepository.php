<?php namespace Insight\Companies;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 2:20 PM
 */


/**
 * Class CompanyRepository
 * @package Insight\Companies
 */
class CompanyRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Company::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Company::find($id);
    }

    /**
     * @param int $num
     * @return mixed
     */
    public function getPaginated($num = 10)
    {
        return Company::paginate($num);
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return Company::lists('name', 'id');
    }

    /**
     * @return array
     */
    public function getCustomersList()
    {
        return ['' => '[Select]'] + Company::where('type', 'customer')->lists('name', 'id');
    }

    /**
     * @param array $company
     * @return mixed
     */
    public function create(Array $company)
    {
        $newCompany = Company::create([
            'name'                  => $company['name'],
            'type'                  => $company['type'],
            'notes'                 => $company['notes'],
            'address1_description'  => $company['address1_description'],
            'address1_body'         => $company['address1_body'],
            'address2_description'  => $company['address2_description'],
            'address2_body'         => $company['address2_body'],
            'address3_description'  => $company['address3_description'],
            'address3_body'         => $company['address3_body'],
            'address4_description'  => $company['address4_description'],
            'address4_body'         => $company['address4_body']
        ]);

        return $newCompany;

    }

    /**
     * @param $company
     * @return array
     */
    public function getAssociatedSuppliersList($company)
    {
        return ['' => '[Select One]'] + $company->suppliers->lists('name', 'id');

    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        Company::destroy($id);
    }

} 