<?php namespace Insight\ProductDefinitions;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 11/3/14
 * Time: 1:47 PM
 */

abstract class ProductDefinitionCommandHandlerAbstract implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var ProductDefinitionRepository
     */
    protected $productDefinitionRepository;

    /**
     * @param ProductDefinitionRepository $productDefinitionRepository
     */
    public function __construct(ProductDefinitionRepository $productDefinitionRepository)
    {
        $this->productDefinitionRepository = $productDefinitionRepository;
    }


} 