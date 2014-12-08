<?php
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:44 PM
 */

use Faker\Factory as Faker;
use Insight\ProductDefinitions\ProductDefinition;

/**
 * Class CompaniesTableSeeder
 */
class ProductDefinitionsTableSeeder extends Seeder {

    /**
     * Run seed command
     */
    public function run()
    {
        if (App::environment('local'))
        {
            Eloquent::unguard();
            ProductDefinition::truncate();

            $faker = Faker::create();

            foreach(range(1, 10) as $index)
            {
                $type = $faker->numberBetween(1,2) == 1 ? 'customer' : 'supplier';
                $creator = $faker->numberBetween(2,11);

                ProductDefinition::create([
                    'user_id' => $creator,
                    'company_id' => $faker->numberBetween(2,11),
                    'code' => $faker->randomLetter . $faker->randomLetter . $faker->unique()->ean8,
                    'name' => strtoupper($faker->word . ' ' . $faker->word . ' ' . $faker->word),
                    'category' => $this->getRandom('categories'),
                    'uom' => $this->getRandom('uom'),
                    'price' => $faker->numberBetween(1, 999) * 100,
                    'currency' => 'AED',
                    'description' => $faker->sentence($faker->numberBetween(5,80)),
                    'short_description' => $faker->sentence($faker->numberBetween(5,20)),
                    'supplier_id' => $faker->numberBetween(1,11),
                    'assigned_user_id' => $creator,
                    'assigned_by_id' => $creator,
                    'status' => 1,
                    'remarks' => $faker->sentence($faker->numberBetween(5,20)),
                    'created_at' => $faker->dateTime('now'),
                    'updated_at' => $faker->dateTime('now')

                ]);
            }
        }


    }

    private function getRandom($type)
    {
        $categories = [
            'Produce',
            'Pantry',
            'Bread & Bakery',
            'Beverages',
            'Frozen',
            'Household',
        ];
        $uom = [
            'Each',
            'Box',
            'Carton',
            'Dozen',
            '20Kg',
            'Pack',
        ];

        $type = $$type;
        return $type[rand(0,count($type) - 1)];
    }

}