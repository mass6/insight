<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contracts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('web_id');
            $table->dateTime('created_time');
            $table->dateTime('update_time');
            $table->string('code')->nullable();
            $table->string('cname')->nullable();
            $table->string('name')->nullable();
            $table->string('website')->nullable();
            $table->string('store')->nullable();
            $table->string('customer')->nullable();
            $table->string('user1')->nullable();
            $table->string('user2')->nullable();
            $table->string('user3')->nullable();
            $table->string('user4')->nullable();
            $table->string('user5')->nullable();
            $table->string('user6')->nullable();
            $table->string('user7')->nullable();
            $table->string('user8')->nullable();
            $table->string('user9')->nullable();
            $table->string('user10')->nullable();
            $table->string('user11')->nullable();
            $table->string('user12')->nullable();
            $table->string('user13')->nullable();
            $table->string('user14')->nullable();
            $table->string('user15')->nullable();
            $table->string('user16')->nullable();
            $table->string('user17')->nullable();
            $table->string('user18')->nullable();
            $table->string('user19')->nullable();
            $table->string('user20')->nullable();
            $table->string('name_bill')->nullable();
            $table->string('street_bill')->nullable();
            $table->string('street1_bill')->nullable();
            $table->string('city_bill')->nullable();
            $table->string('country_bill')->nullable();
            $table->string('state_bill')->nullable();
            $table->string('zip_bill')->nullable();
            $table->string('name_ship1')->nullable();
            $table->string('street_ship1')->nullable();
            $table->string('street1_ship1')->nullable();
            $table->string('city_ship1')->nullable();
            $table->string('country_ship1')->nullable();
            $table->string('state_ship1')->nullable();
            $table->string('zip_ship1')->nullable();
            $table->string('name_ship2')->nullable();
            $table->string('street_ship2')->nullable();
            $table->string('street1_ship2')->nullable();
            $table->string('city_ship2')->nullable();
            $table->string('country_ship2')->nullable();
            $table->string('state_ship2')->nullable();
            $table->string('zip_ship2')->nullable();
            $table->string('name_ship3')->nullable();
            $table->string('street_ship3')->nullable();
            $table->string('street1_ship3')->nullable();
            $table->string('city_ship3')->nullable();
            $table->string('country_ship3')->nullable();
            $table->string('state_ship3')->nullable();
            $table->string('zip_ship3')->nullable();
            $table->string('street_ship4')->nullable();
            $table->string('name_ship4')->nullable();
            $table->string('street1_ship4')->nullable();
            $table->string('city_ship4')->nullable();
            $table->string('country_ship4')->nullable();
            $table->string('state_ship4')->nullable();
            $table->string('zip_ship4')->nullable();
            $table->string('name_ship5')->nullable();
            $table->string('street_ship5')->nullable();
            $table->string('street1_ship5')->nullable();
            $table->string('city_ship5')->nullable();
            $table->string('country_ship5')->nullable();
            $table->string('state_ship5')->nullable();
            $table->integer('zip_ship5')->nullable();
            $table->string('alo')->nullable();
            $table->decimal('budget')->nullable();
            $table->string('budget_currency')->nullable();
            $table->string('budget_period')->nullable();
            $table->date('budget_period_from')->nullable();
            $table->date('budget_period_to')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contracts');
	}

}
