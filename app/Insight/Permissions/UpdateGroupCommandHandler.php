<?php namespace Insight\Permissions;
use Insight\Permissions\Events\GroupWasUpdated;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:29 AM
 */

class UpdateGroupCommandHandler extends GroupCommandHandler
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $group = $this->group->find($command->id);

        $group->name = $command->name;
        unset($group->permissions);
        $group->permissions = $this->serializePermissions($command->permissions);

        $group->save();

        $group->raise(new GroupWasUpdated($group));
        $this->dispatchEventsFor($group);

    }
}