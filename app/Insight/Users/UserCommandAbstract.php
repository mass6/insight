<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 9:40 PM
 */

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

abstract class UserCommandAbstract implements CommandHandler
{

    use DispatchableTrait;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    protected function serializePermissions($permissionsAllowed, $permissionsDenied)
    {
        if (! empty($permissionsAllowed) || ! empty($permissionsDenied)){

            $allowedPermissions = array_diff($permissionsAllowed, $permissionsDenied);
            $serialized = [];

            // write the allowed permissions
            if (! empty($allowedPermissions)){

                foreach ($allowedPermissions as $permission)
                {
                    $serialized[$permission] = 1;
                }
            }

            // write the denied permissions
            if (! empty($permissionsDenied)){
                foreach ($permissionsDenied as $permission)
                {
                    $serialized[$permission] = -1;
                }
            }

            return $serialized;

        } else
            return [];

    }

    public function assignUserToGroups($user, array $newGroups, $currentGroups = null)
    {
        foreach ($newGroups as $groupName)
        {
            $group = Sentry::findGroupByName($groupName);
            $user->addGroup($group);
        }

        if (! empty($currentGroups)){
            $oldGroups = array_diff($currentGroups, $newGroups);

            foreach ($oldGroups as $groupName)
            {
                $group = Sentry::findGroupByName($groupName);
                $user->removeGroup($group);
            }
        }
    }
    
} 