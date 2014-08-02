<?php namespace Insight\Permissions;
use Aws\CloudFront\Exception\Exception;
use Insight\Permissions\Events\GroupWasCreated;
use Laracasts\Commander\Events\DispatchableTrait;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 10:29 PM
 */

class AddNewGroupCommandHandler extends GroupCommandHandler
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // Create the Group
        try
        {
            $group = Sentry::createGroup([
                'name'        => $command->name,
                'permissions' => $this->serializePermissions($command->permissions)
            ]);
        }
        catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            echo 'Group already exists';
        }
        catch (Exception $e)
        {
            return 'Could not create group.';
        }

        $group->raise(new GroupWasCreated($group));

        $this->dispatchEventsFor($group);

    }

}