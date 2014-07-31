<?php namespace Insight\Core;
/**
 * Created by:
 * User: sam
 * Date: 7/27/14
 * Time: 1:02 AM
 */

use App;

trait CommandBus 
{
    /**
     * Execute the command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        return $this->getCommandBus()->execute($command);
    }


    /**
     * Fetch the command bus
     *
     * @return mixed
     */
    public function getCommandBus()
    {
        return App::make('Laracasts\Commander\CommandBus');
    }
} 