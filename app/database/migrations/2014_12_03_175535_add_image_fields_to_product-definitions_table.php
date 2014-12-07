<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImageFieldsToProductDefinitionsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('product_definitions', function(Blueprint $table) {
			
			$table->string('image1_file_name')->nullable();
			$table->integer('image1_file_size')->nullable();
			$table->string('image1_content_type')->nullable();
			$table->timestamp('image1_updated_at')->nullable();

			$table->string('image2_file_name')->nullable();
			$table->integer('image2_file_size')->nullable();
			$table->string('image2_content_type')->nullable();
			$table->timestamp('image2_updated_at')->nullable();

			$table->string('image3_file_name')->nullable();
			$table->integer('image3_file_size')->nullable();
			$table->string('image3_content_type')->nullable();
			$table->timestamp('image3_updated_at')->nullable();

			$table->string('image4_file_name')->nullable();
			$table->integer('image4_file_size')->nullable();
			$table->string('image4_content_type')->nullable();
			$table->timestamp('image4_updated_at')->nullable();

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

			$table->dropColumn('image1_file_name');
			$table->dropColumn('image1_file_size');
			$table->dropColumn('image1_content_type');
			$table->dropColumn('image1_updated_at');

			$table->dropColumn('image2_file_name');
			$table->dropColumn('image2_file_size');
			$table->dropColumn('image2_content_type');
			$table->dropColumn('image2_updated_at');

			$table->dropColumn('image3_file_name');
			$table->dropColumn('image3_file_size');
			$table->dropColumn('image3_content_type');
			$table->dropColumn('image3_updated_at');

			$table->dropColumn('image4_file_name');
			$table->dropColumn('image4_file_size');
			$table->dropColumn('image4_content_type');
			$table->dropColumn('image4_updated_at');

		});
	}

}
