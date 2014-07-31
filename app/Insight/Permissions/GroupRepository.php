<?php namespace Insight\Permissions;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 3:32 PM
 */

class GroupRepository 
{
    public function getAll()
    {
        return Sentry::findAllGroups();
    }

    public function getList()
    {
        return Group::lists('name');
    }
    public function getPaginated($num = 10)
    {
        return Group::paginate($num);
    }

    public function find($id)
    {
        return Group::findOrFail($id);
    }

    public function getAssignedPermissions($group)
    {
        $group = $this->find($group->id);
        return $group->getAssignedPermissions();
    }

    public function delete($id)
    {
        return Group::destroy($id);
    }


} 