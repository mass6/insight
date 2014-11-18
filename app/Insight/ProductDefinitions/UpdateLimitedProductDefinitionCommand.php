<?php namespace Insight\ProductDefinitions; 
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:11 PM
 */


/**
 * Class UpdateLimitedProductDefinitionCommand
 * @package Insight\ProductDefinitions
 */
class UpdateLimitedProductDefinitionCommand
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $user_id;

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
    public $assigned_user_id;
    /**
     * @var
     */
    public $status;
    /**
     * @var
     */
    public  $images;

    /**
     * @var
     */
    public  $attachments;
    /**
     * @var
     */
    public $formType;

    /**
     * @param $id
     * @param $user_id
     * @param $description
     * @param $short_description
     * @param $attributes
     * @param $remarks
     * @param $assigned_user_id
     * @param $status
     * @param $images
     * @param $attachments
     * @param $formType
     */
    public function __construct($id, $user_id, $description, $short_description,
                                $attributes, $remarks, $assigned_user_id, $status, $images, $attachments, $formType)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->attributes = $attributes;
        $this->remarks = $remarks;
        $this->assigned_user_id = $assigned_user_id;
        $this->status = $status;
        $this->images = $images;
        $this->attachments = $attachments;
        $this->formType = $formType;
        $this->short_description = $short_description;
    }
} 