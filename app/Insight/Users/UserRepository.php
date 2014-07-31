<?php namespace Insight\Users;
use Laracasts\Commander\Events\EventGenerator;

/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 12:59 PM
 */



class UserRepository implements UserRepositoryInterface
{

    use EventGenerator;

    /**
     * @var ProfileRepository
     */
    protected $profile;

    public function __construct(ProfileRepository $profile)
    {
        $this->profile = $profile;
    }

    public function getAll()
    {
        $users = User::all();

        return $users;
    }

    public function getPaginated($num = 10)
    {
        $users = User::paginate($num);

        return $users;
    }

    public function find($id)
    {
        return User::with('profile')->findOrFail($id);
    }

    public function getAssignedPermissions($user)
    {
        $permissions = $user->permissions;

        $permissionList = [];

        foreach ($permissions as $key => $val)
        {
            $permissionList[] = $key;
        }
        return $permissionList;
    }

    public function getAssignedGroups($user)
    {
        $user = $this->find($user->id);
        $groups = $user->getGroups();
        $array = [];

        foreach ($groups as $group)
        {
            $array[] = $group->name;
        }
        return $array;

    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function getAllowedAndDeniedPermissions($user)
    {
        $permissions = $user->permissions;
        $combinedPermissons = ['allowed' => [], 'denied' => []];

        foreach ($permissions as $key => $val)
        {
            if ($val === 1)
                $combinedPermissons['allowed'][] = $key;
            elseif ($val === -1)
                $combinedPermissons['denied'][] = $key;
        }
        return $combinedPermissons;

    }

    public function getAllowedPermissions($user)
    {
        $permissions = $user->permissions;
        $allowed = [];

        foreach ($permissions as $key => $val)
        {
            if ($val === 1)
                $allowed[] = $key;
        }
        return $allowed;
    }

    public function getDeniedPermissions($user)
    {
        $permissions = $user->permissions;
        $denied = [];

        foreach ($permissions as $key => $val)
        {
            if ($val === -1)
                $denied[] = $key;
        }
        return $denied;
    }


    
} 