<?php namespace Insight\Permissions\Events;
use Insight\Permissions\Group;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:58 AM
 */

class GroupWasUpdated
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