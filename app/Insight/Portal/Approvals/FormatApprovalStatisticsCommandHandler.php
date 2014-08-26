<?php namespace Insight\Portal\Approvals;
use Laracasts\Commander\CommandHandler;

/**
 * Insight Client Management Portal:
 * Date: 8/18/14
 * Time: 11:58 AM
 */



class FormatApprovalStatisticsCommandHandler implements CommandHandler
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        //create array from result
        $data = array();

        foreach($command->approvalHistory as $approvalComment) {
            $data[] = $approvalComment;
        }

        //$array = $data;
        //var_dump($array);
        //return false;

        // determine the maximum amount of approvals in result set
        $test = false;
        if (!$test) {
            //$size = count($data); //2510
            //echo $size;
            //return false;
            // get array totals;
            $numapprovals = 1;
            $maxapprovals = 1;
            $max_id = '';
            $id = '';
            $last_id = '';
            for ($i = 0; $i < count($data); $i++) {
                $id = $data[$i]['entity_id']; // current approval comment entity_id

                // check if line is same order as last row
                if($id == $last_id){
                    $numapprovals++;
                    //count if order has the max amount of approvals
                    if($numapprovals > $maxapprovals){
                        $maxapprovals = $numapprovals;
                        $max_id = $id;
                    }
                } else {
                    // line is a new order
                    $numapprovals = 1;
                    $last_id = $id;
                }
            }

            $formatted = array();
            $report = [];
            $newline = 0;
            $headarray = array(
                'Order No',
                'Customer',
                'Contract',
                'Status',
                'Ordered On',
                'Placed By',
                'Total Lead Time (Hrs)',
                'Avg Lead Time (Hrs)',
            );
            for ($n=0; $n < $maxapprovals; $n++) {
                $headarray[] = ($n ==0) ? 'Final Approval By' : 'Approved By';
                $headarray[] = ($n ==0) ? 'Final Approval At' : 'Approved At';
                $headarray[] = 'Lead Time (Hrs)';
            }

            $newline++;
            //return $formatted;
            //return array("Num"=>$numapprovals, "Max"=>$maxapprovals, "Max_ID"=>$max_id);
            // add calculations to the array
            $rownum = 0;
            $count = 1;
            $id = '';
            $last_id = '';
            $numapprovals = 0;
            $lines = count($data); // number of lines in master array
            $appdate = array();  // approval dates
            $appname = array();  // approver names

//            return 'Ordered: ' . strtotime($data[0]['ordered_on']) . '  Approved: ' . strtotime($data[0]['comment_date']) . '  Difference: '
//            .  $this->seconds2human( strtotime($data[0]['comment_date'])  - strtotime($data[0]['ordered_on']) ) ;

            for ($c=0; $c < $lines; $c++) {	//$c = current line of master array  (0-424)
                // save approval date and name in array
                $appdate[] = $data[$c]['comment_date'];
                $appname[] = $data[$c]['approver'];

                //check if line is last approval comment, or last line of array
                if ($c == ($lines - 1) || $data[$c]['entity_id'] != $data[$c+1]['entity_id'] ) {
                    // add new record to $formatted
                    $formatted[$newline][0] = $data[$c]['increment_id'];
                    $formatted[$newline][1] = $data[$c]['customer'];
                    $formatted[$newline][2] = $data[$c]['contract'];
                    $formatted[$newline][3] = $data[$c]['status'];
                    $formatted[$newline][4] = $data[$c]['ordered_on'];
                    $formatted[$newline][5] = $data[$c]['ordered_by'];
                    $totaldiff = round((strtotime($data[$c]['comment_date']) - strtotime($data[$c]['ordered_on'])) / 3600, 2);
                    $avgdiff = round($totaldiff / $count, 2);
                    $formatted[$newline][6] = $totaldiff;
                    $formatted[$newline][7] = $avgdiff;
                    for($a=$count-1; $a >= 0; $a--){
                        //write contents of approval arrays into same record line
                        $formatted[$newline][] = $appname[$a];
                        $formatted[$newline][] = $appdate[$a];
                        $diff = ($a > 0) ? round((strtotime($appdate[$a]) - strtotime($appdate[$a-1])) / 3600,2) :
                            round((strtotime($appdate[$a]) - strtotime($data[$c]['ordered_on'])) / 3600,2);
                        $formatted[$newline][] = $diff;
                    }
                    if ($count < $maxapprovals) {
                        for ($i = 0; $i < $maxapprovals - $count; $i++)
                        {
                            $formatted[$newline][] = '';
                            $formatted[$newline][] = '';
                            $formatted[$newline][] = '';
                        }
                    }
                    unset($appdate);
                    unset($appname);
                    $count = 1; // reset counter
                    $newline++; // increment $formatted index
                } else { // this line is not the last approval line for order
                    $count++;
                }
            }

            //$report = $this->formatTable($formatted);
            return array('header' => $headarray, 'report' => $formatted);
        } else {
            return 'This is a test return value';
        }
    }

    private function seconds2human($ss, $titles = false)
    {
        $s = $ss%60;
        $m = floor(($ss%3600)/60);
        $h = floor(($ss%86400)/3600);
        $d = floor(($ss%2592000)/86400);
        $M = floor($ss/2592000);
        $hours = floor($ss / 3600);
        $minutes = floor(($ss / 60) % 60);
        $seconds = $ss % 60;

        if($titles)
            return "{$d} days, {$h} hrs, {$m} min";
        else
            return "{$hours}:{$minutes}:{$seconds}";
    }

}