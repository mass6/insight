<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 4:31 PM
 */

use Insight\Users\Events\UserCreated;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class AddNewUserCommandHandler extends UserCommandAbstract
{

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // Create the User
        try
        {
            $user = Sentry::createUser([
                'email'         =>  $command->email,
                'password'      => $command->password,
                'first_name'    => $command->first_name,
                'last_name'     =>  $command->last_name,
                'company'       =>  $command->company,
                'activated'     =>  true,
                'permissions'   => $this->serializePermissions($command->permissionsAllowed, $command->permissionsDenied)
            ]);

            $user->profile()->save(new Profile);
        }
        catch(Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return $e;
        }

        $this->assignUserToGroups($user, $command->groups);

        $user->raise(new UserCreated($user));

        $this->dispatchEventsFor($user);

        return $user;
    }

}