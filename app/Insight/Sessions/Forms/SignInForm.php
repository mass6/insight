<?php namespace Insight\Sessions\Forms;
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:05 PM
 */
use Laracasts\Validation\FormValidator;

class SignInForm extends FormValidator
{
    /**
     * Validation rules for the registration form
     *
     * @var array
     */
    protected $rules = [
        'email'     => 'required',
        'password'  => 'required'
    ];

}