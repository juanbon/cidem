<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAreaLineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('area_line', function(Blueprint $table)
		{
			$table->foreign('area_id', 'line_area_areas_id_fk')->references('id')->on('areas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('line_id', 'line_area_lines_id_fk')->references('id')->on('lines')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('area_line', function(Blueprint $table)
		{
			$table->dropForeign('line_area_areas_id_fk');
			$table->dropForeign('line_area_lines_id_fk');
		});
	}

}
