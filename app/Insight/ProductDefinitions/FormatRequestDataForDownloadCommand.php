<?php namespace Insight\ProductDefinitions; 
/**
 * Insight Client Management Portal:
 * Date: 11/30/14
 * Time: 11:44 AM
 */

/**
 * Class FormatRequestDataForDownloadCommand
 * @package Insight\ProductDefinitions
 */
class FormatRequestDataForDownloadCommand
{
    /**
     * @var
     */
    public $filter;
    /**
     * @var
     */
    public $format;
    /**
     * @var
     */
    public $customerId;

    /**
     * @param $filter
     * @param $format
     * @param $customerId
     */
    public function __construct($filter, $format, $customerId)
    {
        $this->filter = $filter;
        $this->format = $format;
        $this->customerId = $customerId;
    }
} 