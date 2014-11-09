<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 11:50 PM
 */

class UpdateUserCommand 
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $company_id;
    public $permissionsAllowed;
    public $groups;
    public $permissionsDenied;
    public $send_email;

    public function __construct($id, $first_name, $last_name, $email, $password, $company_id, $send_email, $permissionsAllowed, $permissionsDenied, $groups)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->company_id = $company_id;
        $this->send_email = $send_email;
        $this->permissionsAllowed = $permissionsAllowed;
        $this->permissionsDenied = $permissionsDenied;
        $this->groups = $groups;
    }

} 