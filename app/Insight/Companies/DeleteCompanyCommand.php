<?php namespace Insight\Companies;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:28 PM
 */

/**
 * Class AddNewCompanyCommand
 * @package Insight\Companies
 */
class DeleteCompanyCommand
{
    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }
} 