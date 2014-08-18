<?php namespace Insight\Portal\Contracts; 
/**
 * Insight Client Management Portal:
 * Date: 8/10/14
 * Time: 3:22 PM
 */

class UpdateContractsCommand
{
    /**
     * @var array
     */
    public $localContracts;

    /**
     * @var array
     */
    public $portalContracts;

    public function __construct(Array $localContracts, Array $portalContracts)
    {
        $this->localContracts = $localContracts;
        $this->portalContracts = $portalContracts;
    }
    
} 