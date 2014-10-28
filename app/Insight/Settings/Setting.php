<?php namespace Insight\Settings;


/**
 * Class Setting
 * @package Insight\Settings
 */
class Setting extends \Eloquent {

    /**
     * @var array
     */
    protected $fillable = ['name', 'value'];

    /**
     * @var string
     */
    protected $table = 'settings';
}