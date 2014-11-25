<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDefinitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_definitions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('code');
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('uom')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('attributes')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->integer('assigned_user_id')->unsigned();
            $table->integer('assigned_by_id')->unsigned()->nullable();
            $table->integer('updated_by_id')->unsigned()->nullable();
            $table->integer('status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assigned_user_id')->references('id')->on('users');
            $table->foreign('assigned_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('supplier_id')->references('id')->on('companies');
            $table->foreign('status')->references('id')->on('product_definition_statuses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_definitions');
	}

}
