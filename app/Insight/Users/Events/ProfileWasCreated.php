<?php namespace Insight\Users\Events;
use Insight\Users\User;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 5:14 PM
 */

class ProfileWasCreated
{
    /**
     * @var \Insight\Users\User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
} 