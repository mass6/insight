<?php
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:44 PM
 */

use Faker\Factory as Faker;
use Insight\Companies\Company;

/**
 * Class CompaniesTableSeeder
 */
class CompaniesTableSeeder extends Seeder {

    /**
     * Run seed command
     */
    public function run()
    {

        // Default Company
        Company::create([
            'name' => '36s',
            'type' => 'supplier',
        ]);

        $faker = Faker::create();

        foreach(range(1, 10) as $index)
        {
            $type = $faker->numberBetween(1,2) == 1 ? 'customer' : 'supplier';
            Company::create([
                'name' => $faker->unique()->company,
                'type' => $type,
            ]);
        }
    }

}