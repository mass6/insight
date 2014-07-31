<?php namespace Insight\Users\Events;
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 7:54 PM
 */

use Cartalyst\Sentry\Users\Eloquent\User as User;

class UserUpdated
{
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 