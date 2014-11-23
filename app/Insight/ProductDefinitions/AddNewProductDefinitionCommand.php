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
    public $user;
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
    public $short_description;
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
    /**
     * @var
     */
    public $action;
    /**
     * @var
     */
    public  $image1;
    /**
     * @var
     */
    public  $image2;
    /**
     * @var
     */
    public  $image3;
    /**
     * @var
     */
    public  $image4;
    /**
     * @var
     */
    public  $attachments;


    /**
     * @param $user
     * @param $code
     * @param $name
     * @param $user_id
     * @param $company_id
     * @param $category
     * @param $uom
     * @param $price
     * @param $currency
     * @param $description
     * @param $short_description
     * @param $attributes
     * @param $remarks
     * @param $supplier_id
     * @param $status
     * @param $action
     * @param $image1
     * @param $image2
     * @param $image3
     * @param $image4
     * @param $attachments
     */
    public function __construct($user, $code, $name, $user_id, $company_id, $category, $uom, $price, $currency, $description, $short_description,
                                $attributes, $remarks, $supplier_id, $status, $action, $image1, $image2, $image3, $image4, $attachments)
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
        $this->short_description = $short_description;
        $this->attributes = $attributes;
        $this->remarks = $remarks;
        $this->supplier_id = $supplier_id;
        $this->status = $status;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->image4 = $image4;
        $this->attachments = $attachments;
        $this->user = $user;
        $this->action = $action;
    }
}