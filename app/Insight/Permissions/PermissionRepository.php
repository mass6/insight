<?php namespace Insight\Permissions; 
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 2:20 PM
 */


class PermissionRepository
{
    public function getAll()
    {
        return Permission::all();
    }

    public function getPaginated($num = 10)
    {
        return Permission::paginate($num);
    }

    public function getList()
    {
        return Permission::lists('name');
    }

    public function create($permission)
    {
        $permission = Permission::create([
            'name'  => $permission['name']
        ]);

        return $permission;

    }

    public function delete($id)
    {
        Permission::destroy($id);
    }

} 