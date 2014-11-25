<?php
use Insight\ProductDefinitions\ProductDefinitionStatuses;

/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 4:44 PM
 */


class ProductDefinitionStatusesTableSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();
        ProductDefinitionStatuses::truncate();

        // Draft
        ProductDefinitionStatuses::create([
            'name'  => 'Draft',
        ]);
        // Submitted
        ProductDefinitionStatuses::create([
            'name'  => 'Submitted',
        ]);
        // Processing
        ProductDefinitionStatuses::create([
            'name'  => 'Processing',
        ]);
        // Complete
        ProductDefinitionStatuses::create([
            'name'  => 'Complete',
        ]);
        // On Hold
        ProductDefinitionStatuses::create([
            'name'  => 'On Hold',
        ]);
        // Cancelled
        ProductDefinitionStatuses::create([
            'name'  => 'Cancelled',
        ]);

    }

}