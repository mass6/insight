<?php namespace Insight\Companies;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:28 PM
 */

/**
 * Class AddNewCompanyCommand
 * @package Insight\Companies
 */
class AddNewCompanyCommand
{

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $notes;

    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $address1_description;
    /**
     * @var
     */
    public $address1_body;
    /**
     * @var
     */
    public $address2_description;
    /**
     * @var
     */
    public $address2_body;
    /**
     * @var
     */
    public $address3_description;
    /**
     * @var
     */
    public $address3_body;
    /**
     * @var
     */
    public $address4_description;
    /**
     * @var
     */
    public $address4_body;


    /**
     * @param $name
     * @param $type
     * @param $notes
     * @param $address1_description
     * @param $address1_body
     * @param $address2_description
     * @param $address2_body
     * @param $address3_description
     * @param $address3_body
     * @param $address4_description
     * @param $address4_body
     */
    public function __construct($name, $type, $notes,
        $address1_description, $address1_body, $address2_description, $address2_body,
        $address3_description, $address3_body, $address4_description, $address4_body)
    {
        $this->name = $name;
        $this->type = $type;
        $this->notes = $notes;
        $this->address1_description = $address1_description;
        $this->address1_body = $address1_body;
        $this->address2_description = $address2_description;
        $this->address2_body = $address2_body;
        $this->address3_description = $address3_description;
        $this->address3_body = $address3_body;
        $this->address4_description = $address4_description;
        $this->address4_body = $address4_body;
    }
} 