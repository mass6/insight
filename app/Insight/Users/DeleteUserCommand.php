<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 3:40 PM
 */


class DeleteUserCommand 
{
    /**
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
} 