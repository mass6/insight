<?php namespace Insight\Portal\Contracts\Events; 
/**
 * Insight Client Management Portal:
 * Date: 8/14/14
 * Time: 2:23 PM
 */

class ContractsWereUpdated 
{
    public $changeLog;

    public function __construct($changeLog)
    {
        $this->changeLog = $changeLog;
    }
} 