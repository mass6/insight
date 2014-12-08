<?php

use Insight\Settings\Setting;

class SettingsTableSeeder extends Seeder {

	public function run()
	{
        Setting::truncate();

        // notification settings
        Setting::create([
            'name'  => 'portal-data-update-notifications',
            'type'  => 'notifications'
        ]);
        // primary cataloguer
        Setting::create([
            'name'  => 'primary-cataloguer',
            'type'  => 'product-cataloguing'
        ]);
        // primary catalogue processor
        Setting::create([
            'name'  => 'primary-provisioner',
            'type'  => 'product-cataloguing'
        ]);

	}

}