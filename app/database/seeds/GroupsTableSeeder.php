<?php
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:44 PM
 */


class GroupsTableSeeder extends Seeder {

    public function run()
    {
        Sentry::createGroup(array(
            'name'        => 'Administrator',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
            ),
        ));
    }

}