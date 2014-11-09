<?php namespace Insight\Users\Forms; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 3:38 PM
 */

use Laracasts\Validation\FormValidator;

class NewUserForm extends FormValidator
{
    /**
     * Validation rules for the registration form
     *
     * @var array
     */
    protected $rules = [
        'email'     => 'required|email|unique:users',
        'password'  => 'required|digits_between:6,30',
        'company_id'   => 'required'
    ];
    
} 