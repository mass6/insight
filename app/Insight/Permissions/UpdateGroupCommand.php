<?php namespace Insight\Permissions; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:23 AM
 */

class UpdateGroupCommand 
{
    public $id;
    public $name;
    public $permissions;

    public function __construct($id, $name, $permissions)
    {

        $this->id = $id;
        $this->name = $name;
        $this->permissions = $permissions;
    }
} 