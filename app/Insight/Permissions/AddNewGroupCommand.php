<?php namespace Insight\Permissions; 
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:28 PM
 */

class AddNewGroupCommand 
{

    public $name;
    /**
     * @var array
     */
    public $permissions;

    public function __construct($name, Array $permissions = [])
    {
        $this->name = $name;
        $this->permissions = $permissions;
    }
} 