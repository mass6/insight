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

        // New
        ProductDefinitionStatuses::create([
            'name'  => 'New',
        ]);
        // Pending Customer
        ProductDefinitionStatuses::create([
            'name'  => 'Pending Customer',
        ]);
        // Pending Supplier
        ProductDefinitionStatuses::create([
            'name'  => 'Pending Supplier',
        ]);
        // Pending 36S
        ProductDefinitionStatuses::create([
            'name'  => 'Pending 36S',
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