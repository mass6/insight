<?php namespace Insight\Permissions; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 2:03 AM
 */

class DeleteGroupCommand 
{
    public  $group;

    public function __construct($group)
    {
        $this->group = $group;
    }
} 