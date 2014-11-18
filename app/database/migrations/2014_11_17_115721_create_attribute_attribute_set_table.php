<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeAttributeSetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_attribute_set', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('attribute_id')->unsigned()->index();
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
			$table->integer('attribute_set_id')->unsigned()->index();
			$table->foreign('attribute_set_id')->references('id')->on('attribute_sets')->onDelete('cascade');
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
		Schema::drop('attribute_attribute_set');
	}

}
