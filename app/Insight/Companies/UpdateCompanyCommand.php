<?php namespace Insight\Companies;
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:23 AM
 */

/**
 * Class UpdateCompanyCommand
 * @package Insight\Companies
 */
class UpdateCompanyCommand
{
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $notes;

    /**
     * @param $id
     * @param $name
     * @param $type
     * @param $notes
     */
    public function __construct($id, $name, $type, $notes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->notes = $notes;
    }
} 