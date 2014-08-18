<?php namespace Insight\Portal\Contracts; 
/**
 * Insight Client Management Portal:
 * Date: 8/13/14
 * Time: 10:02 AM
 */

class ContractRepository 
{

    public function getAll()
    {
        return Contract::all();
    }

    public function addContract($contract)
    {
        return Contract::create($contract);
    }

    public function deleteContract($contract)
    {
        $contract = Contract::where('web_id', $contract['web_id'])->first();
        return $contract->delete();
    }

    public function updateColumns($id, $columnUpdates)
    {
        $contract = Contract::where('web_id', $id)->first();

        if ($contract)
        {
            $changes = [];
            foreach ($columnUpdates as $update)
            {
                $contract->$update['column'] = $update['value'];
                $changes[] = $update['description'];
            }
            if ($contract->save()) {
                return $changes;
            } else {
                return false;
            }
        } else {
            return false;
        }


    }
} 