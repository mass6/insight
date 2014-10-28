<?php

use Insight\Settings\Setting;

class SettingsTableSeeder extends Seeder {

	public function run()
	{

        // add superuser permission
        Setting::create([
            'name'  => 'portal-data-update-notifications',
            'type'  => 'notifications'
        ]);

	}

}