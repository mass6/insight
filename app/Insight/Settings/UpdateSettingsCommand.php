<?php namespace Insight\Settings;
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:23 AM
 */

/**
 * Class UpdateSettingsCommand
 * @package Insight\Settings
 */
class UpdateSettingsCommand
{
    /**
     * The type of settings being updated
     *
     * @var
     */
    public $type;
    /**
     * Input array to be processed
     *
     * @var
     */
    public $input;

    /**
     * @param $type
     * @param $input
     */
    public function __construct($type, $input)
    {
        $this->type = $type;
        $this->input = $input;
    }
} 