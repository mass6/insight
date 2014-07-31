<?php namespace Insight\Sessions\Forms;
use Laracasts\Validation\FormValidator;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

/**
 * Insight Client Management Portal:
 * Date: 7/30/14
 * Time: 2:37 PM
 */

class UpdatePasswordForm extends FormValidator
{
    /**
     * Validation rules for the registration form
     *
     * @var array
     */
    protected $rules = [
        'password'  => 'required|digits_between:6,30|confirmed'
    ];


} 