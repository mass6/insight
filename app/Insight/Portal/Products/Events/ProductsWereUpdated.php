<?php namespace Insight\Portal\Products\Events;
/**
 * Insight Client Management Portal:
 * Date: 8/14/14
 * Time: 2:23 PM
 */

class ProductsWereUpdated
{
    public $changeLog;

    public function __construct($changeLog)
    {
        $this->changeLog = $changeLog;
    }
} 