<?php namespace Insight\Portal\Products;
/**
 * Insight Client Management Portal:
 * Date: 8/10/14
 * Time: 3:22 PM
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

    public function __construct(Array $localProducts, Array $portalProducts)
    {

        $this->localProducts = $localProducts;
        $this->portalProducts = $portalProducts;
    }
    
} 