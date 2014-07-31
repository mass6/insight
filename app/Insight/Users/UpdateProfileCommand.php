<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 8:13 PM
 */

class UpdateProfileCommand 
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var array
     */
    public $data;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }
} 