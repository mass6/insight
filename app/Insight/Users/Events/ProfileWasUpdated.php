<?php namespace Insight\Users\Events;
use Insight\Users\User;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 8:15 PM
 */

class ProfileWasUpdated
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