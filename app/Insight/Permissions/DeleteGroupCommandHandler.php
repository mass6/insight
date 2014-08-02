<?php namespace Insight\Permissions;
use Insight\Permissions\Events\GroupWasDeleted;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 2:05 AM
 */

class DeleteGroupCommandHandler extends GroupCommandHandler
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $savedGroup = clone $command->group;

        $this->group->delete($command->group->id);

        $savedGroup->raise(new GroupWasDeleted($savedGroup));

        $this->dispatchEventsFor($savedGroup);

    }
}