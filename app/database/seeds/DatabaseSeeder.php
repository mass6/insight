<?php

class DatabaseSeeder extends Seeder {

    /**
     * @var array
     */
    protected $tables = ['groups', 'users', 'permissions'];

    /**
     * @var array
     */
    protected $seeders = [
        'GroupsTableSeeder',
        'UsersTableSeeder',
        'PermissionsTableSeeder'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->cleanDatabase();

        $this->seedDatabase();
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
