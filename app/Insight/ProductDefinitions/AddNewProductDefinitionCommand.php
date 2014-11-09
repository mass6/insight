<?php namespace Insight\ProductDefinitions; 
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:11 PM
 */

/**
 * Class AddNewProductDefinitionCommand
 * @package Insight\ProductDefinitions
 */
class AddNewProductDefinitionCommand
{
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
    public $user_id;
    /**
     * @var
     */
    public $company_id;
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
    public $description;
    /**
     * @var
     */
    public $attributes;
    /**
     * @var
     */
    public $remarks;
    /**
     * @var
     */
    public $supplier_id;
    /**
     * @var
     */
    public $assigned_user_id;
    /**
     * @var
     */
    public $status;
    public  $images;
    public  $attachments;

    /**
     * @param $code
     * @param $name
     * @param $user_id
     * @param $company_id
     * @param $category
     * @param $uom
     * @param $price
     * @param $currency
     * @param $description
     * @param $attributes
     * @param $remarks
     * @param $supplier_id
     * @param $assigned_user_id
     * @param $status
     */
    public function __construct($code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description,
                                $attributes, $remarks, $supplier_id, $assigned_user_id, $status, $images, $attachments)
    {
        $this->code = $code;
        $this->name = $name;
        $this->user_id = $user_id;
        $this->company_id = $company_id;
        $this->category = $category;
        $this->uom = $uom;
        $this->price = $price;
        $this->currency = $currency;
        $this->description = $description;
        $this->attributes = $attributes;
        $this->remarks = $remarks;
        $this->supplier_id = $supplier_id;
        $this->assigned_user_id = $assigned_user_id;
        $this->status = $status;
        $this->images = $images;
        $this->attachments = $attachments;
    }
} 