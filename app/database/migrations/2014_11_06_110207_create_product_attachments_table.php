<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_attachments', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('attachable_id');
            $table->string('attachable_type');
            $table->string("attachment_file_name")->nullable();
            $table->integer("attachment_file_size")->nullable();
            $table->string("attachment_content_type")->nullable();
            $table->timestamp("attachment_updated_at")->nullable();
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
		Schema::drop('product_attachments');
	}

}
