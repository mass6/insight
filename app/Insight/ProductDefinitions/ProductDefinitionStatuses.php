<?php namespace Insight\ProductDefinitions;

/**
 * Class ProductDefinitionStatuses
 * @package Insight\ProductDefinitions
 */
class ProductDefinitionStatuses extends \Eloquent {


    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var string
     */
    protected $table = 'product_definition_statuses';

}