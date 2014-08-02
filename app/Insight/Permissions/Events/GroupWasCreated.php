<?php namespace Insight\Permissions\Events;
use Insight\Permissions\Group;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:59 PM
 */

class GroupWasCreated
{
    /**
     * @var \Insight\Permissions\Group
     */
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }
    
} 