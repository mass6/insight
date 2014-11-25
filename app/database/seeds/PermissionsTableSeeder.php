<?php

use Insight\Permissions\Permission;

class PermissionsTableSeeder extends Seeder {

    public $count = 40;

	public function run()
	{
        if(Permission::count() < $this->count)
        {
            // add superuser permission
            Permission::create(['name' => 'superuser']);

            $crudActions = ['add', 'edit', 'view', 'delete'];

            $crudPermissions = [
                'users',
                'permissions',
                'groups',
                'product-requests',
                'quotations',
                'companies',
                'cataloguing.products',
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

            // Misc permissions
            Permission::create(['name' => 'portal.doa']);
            Permission::create(['name' => 'customers.data']);
            Permission::create(['name' => 'cataloguing.products.edit.full']);
            Permission::create(['name' => 'cataloguing.products.admin']);
            Permission::create(['name' => 'cataloguing.products.catalogue']);
            Permission::create(['name' => 'cataloguing.products.process']);

        }


    }

}