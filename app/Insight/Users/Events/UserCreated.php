<?php namespace Insight\Users\Events; 
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 1:00 PM
 */

use Cartalyst\Sentry\Users\Eloquent\User as User;

class UserCreated 
{
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 