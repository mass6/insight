<?php namespace Insight\Portal\Approvals; 
/**
 * Insight Client Management Portal:
 * Date: 8/18/14
 * Time: 11:57 AM
 */

class FormatApprovalStatisticsCommand
{
    /**
     * @var
     */
    public $approvalHistory;

    /**
     * @param $approvalHistory
     */
    public function __construct($approvalHistory)
    {
        $this->approvalHistory = $approvalHistory;
    }
} 