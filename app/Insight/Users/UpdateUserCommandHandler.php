<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 4:31 PM
 */

use Insight\Users\Events\UserUpdated;

class UpdateUserCommandHandler extends UserCommandAbstract
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = $this->userRepository->find($command->id);

        // Update the User
        try
        {
            $user->email = $command->email;
            $user->first_name = $command->first_name;
            $user->last_name = $command->last_name;
            $user->company = $command->company;
            unset($user->permissions);
            $user->permissions = $this->serializePermissions($command->permissionsAllowed, $command->permissionsDenied);

            // check to see if password has been updated
            if ($command->password !== null && $command->password !== ''){
                $user->password = $command->password;
            }

            $this->assignUserToGroups($user, $command->groups, $this->userRepository->getAssignedGroups($user));

            $user->save();

        }
        catch(Exception $e)
        {
            return $e;
        }

        $user->raise(new UserUpdated($user));

        $this->dispatchEventsFor($user);

        return $user;

    }

}