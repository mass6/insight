<?php namespace Insight\Companies\Events;
use Insight\Companies\Company;
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 2:12 AM
 */

class CompanyWasDeleted
{
    /**
     * @var Company
     */
    public $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }
} 