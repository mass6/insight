<?php namespace Insight\Users\Forms;
use Laracasts\Validation\FormValidator;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 8:07 PM
 */

class ProfileForm extends FormValidator
{
    /**
     * Validation rules for the profile form
     *
     * @var array
     */
    protected $rules = [
        'mobile'    =>  'max:30',
        'bio'		=> 	'max:1000',
        'avatar'    =>  'image'
    ];
} 