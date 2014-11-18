<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('type');
			$table->text('notes')->nullable();
            $table->string('address1_description')->nullable();
            $table->text('address1_body')->nullable();
            $table->string('address2_description')->nullable();
            $table->text('address2_body')->nullable();
            $table->string('address3_description')->nullable();
            $table->text('address3_body')->nullable();
            $table->string('address4_description')->nullable();
            $table->text('address4_body')->nullable();
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
		Schema::drop('companies');
	}

}