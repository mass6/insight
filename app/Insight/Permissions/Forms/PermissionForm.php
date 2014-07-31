<?php namespace Insight\Permissions\Forms;
use Laracasts\Validation\FormValidator;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 2:13 PM
 */



class PermissionForm extends FormValidator
{
    protected $rules = [
        'name'  => 'required|unique:permissions'
    ];
    
} 