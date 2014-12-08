<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAttachmentFieldsToProductDefinitionsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('product_definitions', function(Blueprint $table) {
			
			$table->string('attachment1_file_name')->nullable();
			$table->integer('attachment1_file_size')->nullable();
			$table->string('attachment1_content_type')->nullable();
			$table->timestamp('attachment1_updated_at')->nullable();

			$table->string('attachment2_file_name')->nullable();
			$table->integer('attachment2_file_size')->nullable();
			$table->string('attachment2_content_type')->nullable();
			$table->timestamp('attachment2_updated_at')->nullable();

			$table->string('attachment3_file_name')->nullable();
			$table->integer('attachment3_file_size')->nullable();
			$table->string('attachment3_content_type')->nullable();
			$table->timestamp('attachment3_updated_at')->nullable();

			$table->string('attachment4_file_name')->nullable();
			$table->integer('attachment4_file_size')->nullable();
			$table->string('attachment4_content_type')->nullable();
			$table->timestamp('attachment4_updated_at')->nullable();

			$table->string('attachment5_file_name')->nullable();
			$table->integer('attachment5_file_size')->nullable();
			$table->string('attachment5_content_type')->nullable();
			$table->timestamp('attachment5_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_definitions', function(Blueprint $table) {

			$table->dropColumn('attachment1_file_name');
			$table->dropColumn('attachment1_file_size');
			$table->dropColumn('attachment1_content_type');
			$table->dropColumn('attachment1_updated_at');

			$table->dropColumn('attachment2_file_name');
			$table->dropColumn('attachment2_file_size');
			$table->dropColumn('attachment2_content_type');
			$table->dropColumn('attachment2_updated_at');

			$table->dropColumn('attachment3_file_name');
			$table->dropColumn('attachment3_file_size');
			$table->dropColumn('attachment3_content_type');
			$table->dropColumn('attachment3_updated_at');

			$table->dropColumn('attachment4_file_name');
			$table->dropColumn('attachment4_file_size');
			$table->dropColumn('attachment4_content_type');
			$table->dropColumn('attachment4_updated_at');

			$table->dropColumn('attachment5_file_name');
			$table->dropColumn('attachment5_file_size');
			$table->dropColumn('attachment5_content_type');
			$table->dropColumn('attachment5_updated_at');

		});
	}

}
