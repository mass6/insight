<?php namespace Insight\Users\Events;
use Insight\Users\User;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 3:46 PM
 */

class UserWasDeleted
{
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
}
