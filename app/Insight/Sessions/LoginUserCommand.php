<?php namespace Insight\Sessions; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 1:05 AM
 */

class LoginUserCommand 
{
    public $credentials;

    function __construct($credentials)
    {
        $this->credentials = $credentials;
    }
} 