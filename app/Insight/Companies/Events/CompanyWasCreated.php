<?php namespace Insight\Companies\Events;
use Insight\Companies\Company;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:59 PM
 */

class CompanyWasCreated
{
    /**
     * @var \Insight\Companies\Company
     */
    public $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    
} 