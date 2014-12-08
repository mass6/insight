<?php
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:44 PM
 */

use Faker\Factory as Faker;
use Insight\Users\Profile;
use Insight\Users\User;

class UsersTableSeeder extends Seeder {

    public function run()
    {

        if(! User::count())
        {
            $adminUser = Sentry::createUser([
                'first_name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'company_id' => '1',
                'activated' => true,
                'permissions' => ['superuser' => 1]
            ]);

            //delete previous/obsolete profiles
            DB::table('profiles')->truncate();

            $adminUser->profile()->save(new Profile);

            // Find the group using the group id
            $adminGroup = Sentry::findGroupById(1);

            // Assign the group to the user
            $adminUser->addGroup($adminGroup);

            if(App::environment('local'))
            {
                $faker = Faker::create();

                foreach(range(1, 10) as $index)
                {
                    Sentry::createUser([
                        'first_name' => $faker->firstName,
                        'last_name' => $faker->lastName,
                        'email' => $faker->unique()->email(),
                        'password' => 'secret',
                        'company_id' => $faker->numberBetween(2,11),
                        'activated' => true
                    ]);
                }

            }
        }

    }

}