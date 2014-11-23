<?php

use Insight\Notifications\Notification;

class NotificationsTableSeeder extends Seeder {

	public function run()
	{

        if(! Notification::count())
        {
            Notification::create([
                'name'  => 'ContractsUpdated'
            ]);
            Notification::create([
                'name'  => 'ProductsUpdated'
            ]);
        }

	}

}