<?php

use Insight\Permissions\Permission;

class PermissionsTableSeeder extends Seeder {

	public function run()
	{

        // add superuser permission
        Permission::create(['name' => 'superuser']);

		$crudActions = ['add', 'edit', 'view', 'delete'];

        $crudPermissions = [
            'users',
            'permissions',
            'groups',
            'product-requests',
            'quotations'
        ];

        $viewPermissions = [
            'dashboards',
            'portal.users',
            'portal.orders',
            'portal.contracts',
            'portal.products'
        ];

        foreach ($crudPermissions as $permission)
        {
            foreach ($crudActions as $action)
            {
                Permission::create(['name' => $permission . '.' . $action]);
            }
        }

        foreach ($viewPermissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

	}

}