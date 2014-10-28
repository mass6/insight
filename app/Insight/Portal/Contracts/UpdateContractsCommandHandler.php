<?php namespace Insight\Portal\Contracts;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Commander\Events\DispatchableTrait;
use Insight\Portal\Contracts\Events\ContractsWereUpdated;
use \Log;
/**
 * Insight Client Management Portal:
 * Date: 8/10/14
 * Time: 3:24 PM
 */

class UpdateContractsCommandHandler implements CommandHandler
{
    use EventGenerator, DispatchableTrait;

    /**
     * @var ContractRepository
     */
    private $contract;

    public $changeLog;

    public function __construct()
{
    $this->contract = new ContractRepository;
}

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $added = 0;
        $deleted = 0;
        $updated = 0;

        $local = $command->localContracts;
        $localContracts = [];
        foreach ($local as $contract)
        {
            unset($contract['id']);
            $localContracts[] = $contract;
        }
        $portal = $command->portalContracts;
        $portalContracts = [];
        foreach ($portal as $contract)
        {
            unset($contract['created_time']);
            unset($contract['update_time']);
            $portalContracts[] = $contract;
        }
//        Log::info('Local');
//        Log::info($localContracts);
//        Log::info('Portal');
//        Log::info($portalContracts);

        $localIds = [];
        $portalIds = [];
        foreach ($localContracts as $contract){
            $localIds[] = (string)$contract['web_id'];
        }
        foreach ($portalContracts as $contract){
            $portalIds[] = $contract['web_id'];
        }


//        Log::info($localIds);
//        Log::info($portalIds);


        // Add contracts
        $toBeAddedIds = array_diff($portalIds, $localIds);
        $numToBeAdded = count($toBeAddedIds);
        $contractsToBeAdded = [];

        foreach ($portalContracts as $contract)
        {
            if ( in_array($contract['web_id'], $toBeAddedIds)){
                $contractsToBeAdded[] = $contract;
            }
        }
        $added = $this->addContracts($contractsToBeAdded);

        // Delete contracts
        $toBeDeletedIds = array_diff($localIds, $portalIds);
        $numToBeDeleted = count($toBeDeletedIds);
        $contractsToBeDeleted = [];

        foreach ($localContracts as $contract)
        {
            if ( in_array($contract['web_id'], $toBeDeletedIds)){
                $contractsToBeDeleted[] = $contract;
            }
        }
        $deleted = $this->deleteContracts($contractsToBeDeleted);

        // Verify Contracts
        $toBeVerifiedIds = array_intersect($localIds,$portalIds);
        $numToBeVerified = count($toBeVerifiedIds);


        $localContracts = $this->contractsToCompare($localContracts, $toBeVerifiedIds);
        $portalContracts = $this->contractsToCompare($portalContracts, $toBeVerifiedIds);

        $contractUpdates = $this->compareContracts($localContracts, $portalContracts);
        $numToBeUpdated = count($contractUpdates);

        // process the contract changes required
        if ($contractUpdates){
            $updated = $this->updateContracts($contractUpdates);
        }

        if ($this->changeLog){
            Log::info($this->changeLog);
            $this->raise(new ContractsWereUpdated($this->changeLog));
            $this->dispatchEventsFor($this);

        } else {
            Log::info("All contracts up to date. No changes to be made.");
        }


        return "To be updated: {$numToBeUpdated}  To be added: {$numToBeAdded}  To be deleted: {$numToBeDeleted} \r\n" .
         "Actual updated: {$updated}  Actual added: {$added}  Actual deleted: {$deleted} ";

    }

    public function addContracts($contracts)
    {
        $added = 0;
        foreach ($contracts as $contract)
        {
            $newContract = $this->contract->addContract($contract);
            if ($newContract){
                $added++;
                $this->changeLog[$contract['customer']]['Added Contracts'][] = $contract['name'];
            }
        }
        return $added;
    }

    public function deleteContracts($contracts)
    {
        $deleted = 0;
        foreach ($contracts as $contract)
        {
            $deletedContract = $this->contract->deleteContract($contract);
            if ($deletedContract){
                $deleted++;
                $this->changeLog[$contract['customer']]['Deleted Contracts'][] = $contract['name'];
            }
        }
        return $deleted;
    }

    public function contractsToCompare($contracts, $ids )
    {
        $array = [];
        foreach ($contracts as $contract)
        {
            if (in_array($contract['web_id'], $ids)){
                $array[$contract['web_id']] = $contract;
            }
        }
        asort($array);
        return $array;
    }

    public function compareContracts($localContracts, $portalContracts)
    {
        $changes = false;

        $contractUpdates = [];
        foreach ($localContracts as $contract)
        {
            $portalContract = $portalContracts[$contract['web_id']];

            $columnUpdates = [];
            $i = 0;
            // Begin column comparison
            foreach ($portalContract as $key => $val)
            {
                if ((string)$val !== (string)$contract[$key]){
                    $differences = ucwords($key) . ' changed from "' . $contract[$key] . '" to "' . $val . '"';
                    $columnUpdates[$i]['contract'] = $portalContract['name'];
                    $columnUpdates[$i]['column'] = $key;
                    $columnUpdates[$i]['value'] = $val;
                    $columnUpdates[$i]['description'] = $differences;
                    $columnUpdates[$i]['customer'] = $portalContract['customer'];

                    $i++;
                    $changes = true;
                }
                //$differences[] = 'Comparing ' . $key . ' = ' . $val . ' with ' . $contract[$key];
            }
            if ($columnUpdates)
                $contractUpdates[$contract['web_id']] = $columnUpdates;
            //$contractUpdates[$contract['web_id']]['descriptions'] = $differences;
        }
        // Updates to be made
        //Log::info($contractUpdates);

        return $contractUpdates;

    }

    public function updateContracts($contractUpdates)
    {
        $updated = 0;
        foreach ($contractUpdates as $contractId => $columnUpdates)
        {
            //Log::info($columnUpdates);
            $updates = $this->contract->updateColumns($contractId, $columnUpdates);
            if ($updates)
            {
                $this->changeLog[$columnUpdates[0]['customer']]['Updated Contracts'][$columnUpdates[0]['contract']] = $updates;
                $updated++;
            }
            //Log::info($contract);
            //Log::info($columnUpdates);
        }
        return $updated;
    }
}