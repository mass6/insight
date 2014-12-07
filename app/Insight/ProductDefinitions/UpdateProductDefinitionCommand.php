<?php namespace Insight\ProductDefinitions; 
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:11 PM
 */
use Insight\ProductDefinitions\Forms\ProductDefinitionForm;
use Insight\Users\User;

/**
 * Class UpdateProductDefinitionCommand
 * @package Insight\ProductDefinitions
 */
class UpdateProductDefinitionCommand
{
    /**
     * @var
     */
    public $user;
    /**
     * @var ProductDefinition
     */
    public $product;
    /**
     * @var
     */
    public $company_id;
    /**
     * @var
     */
    public $supplier_id;
    /**
     * @var
     */
    public $code;
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $category;
    /**
     * @var
     */
    public $uom;
    /**
     * @var
     */
    public $price;
    /**
     * @var
     */
    public $currency;
    /**
     * @var
     */
    public $short_description;
    /**
     * @var
     */
    public $description;
    /**
     * @var
     */
    public $image1;
    /**
     * @var
     */
    public $image2;
    /**
     * @var
     */
    public $image3;
    /**
     * @var
     */
    public $image4;
    /**
     * @var
     */
    public $attachment1;
    /**
     * @var
     */
    public $attachment2;
    /**
     * @var
     */
    public $attachment3;
    /**
     * @var
     */
    public $attachment4;
    /**
     * @var
     */
    public $attachment5;
    /**
     * @var
     */
    public $attributes;
    /**
     * @var
     */
    public $formType;
    /**
     * @var
     */
    public $remarks;
    /**
     * @var
     */
    public $action;


    /**
     * @param User $user
     * @param ProductDefinition $product
     * @param $company_id
     * @param $supplier_id
     * @param $code
     * @param $name
     * @param $category
     * @param $uom
     * @param $price
     * @param $currency
     * @param $short_description
     * @param $description
     * @param $image1
     * @param $image2
     * @param $image3
     * @param $image4
     * @param $attributes
     * @param $formType
     * @param $remarks
     * @param $action
     */
    public function __construct(User $user, ProductDefinition $product, $company_id, $supplier_id, $code, $name, $category, $uom, $price, $currency, $short_description, $description,
                                $image1, $image2, $image3, $image4, $attachment1, $attachment2, $attachment3, $attachment4, $attachment5, $attributes, $formType, $remarks, $action)
    {
        $this->user = $user;
        $this->product = $product;
        $this->company_id = $company_id;
        $this->supplier_id = $supplier_id;
        $this->code = $code;
        $this->name = $name;
        $this->category = $category;
        $this->uom = $uom;
        $this->price = $price;
        $this->currency = $currency;
        $this->short_description = $short_description;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->image4 = $image4;
        $this->attachment1 = $attachment1;
        $this->attachment2 = $attachment2;
        $this->attachment3 = $attachment3;
        $this->attachment4 = $attachment4;
        $this->attachment5 = $attachment5;
        $this->attributes = $attributes;
        $this->formType = $formType;
        $this->remarks = $remarks;
        $this->action = $action;
    }
}