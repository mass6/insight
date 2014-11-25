<?php

class DatabaseSeeder extends Seeder {

    /**
     * @var array
     */
    protected $tables = ['groups', 'users', 'profiles', 'permissions', 'companies', 'product_definition_statuses', 'product_definitions'];

    /**
     * @var array
     */
    protected $seeders = [
        'GroupsTableSeeder',
        'CompaniesTableSeeder',
        'SettingsTableSeeder',
        'NotificationsTableSeeder',
        'UsersTableSeeder',
        'PermissionsTableSeeder',
        'ProductDefinitionStatusesTableSeeder',
        'ProductDefinitionsTableSeeder',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // allow for mass assignment
        Eloquent::unguard();

        DB::statement("SET foreign_key_checks = 0");

        //$this->cleanDatabase();

        $this->seedDatabase();
        DB::statement("SET foreign_key_checks = 1");
    }

    /**
     *
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
            Log::info('Truncated: ' . $table);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     *
     */
    public function seedDatabase()
    {
        foreach ($this->seeders as $seed)
        {
            $this->call($seed);
        }
    }

}
