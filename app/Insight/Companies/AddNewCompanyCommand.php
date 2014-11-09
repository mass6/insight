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
     * @param $name
     * @param $type
     * @param $notes
     */
    public function __construct($name, $type, $notes)
    {
        $this->name = $name;
        $this->type = $type;
        $this->notes = $notes;
    }
} 