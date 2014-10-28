<?php namespace Insight\Portal\Products;
/**
 * Insight Client Management Portal:
 * Date: 8/10/14
 * Time: 3:22 PM
 */

/**
 * Class UpdateProductsCommand
 * @package Insight\Portal\Products
 */
class UpdateProductsCommand
{
    /**
     * @var array
     */
    public $localProducts;

    /**
     * @var array
     */
    public $portalProducts;

    /**
     * @var array
     */
    public $customer;


    /**
     * @param array $localProducts
     * @param array $portalProducts
     * @param array $customer
     */
    public function __construct(Array $localProducts, Array $portalProducts, Array $customer)
    {
        $this->localProducts = $localProducts;
        $this->portalProducts = $portalProducts;
        $this->customer = $customer;
    }
    
} 