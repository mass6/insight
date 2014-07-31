<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id');
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->string('mobile')->nullable();
            $table->string('skype_name')->nullable();
            $table->text('bio')->nullable();
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
		Schema::drop('profiles');
	}

}
