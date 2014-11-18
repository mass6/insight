<?php namespace Insight\Companies\Events;
use Insight\Companies\Company;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:58 AM
 */

class CompanyWasUpdated
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