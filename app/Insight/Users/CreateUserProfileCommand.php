<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 5:04 PM
 */

class CreateUserProfileCommand 
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