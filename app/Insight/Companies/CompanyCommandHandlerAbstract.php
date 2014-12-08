<?php namespace Insight\Companies;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 11/3/14
 * Time: 1:47 PM
 */

abstract class CompanyCommandHandlerAbstract implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


} 