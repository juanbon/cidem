<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreaLineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_line', function(Blueprint $table)
		{
			$table->integer('line_id')->index('line_area_lines_id_fk')->unsigned()->nullable();
			$table->integer('area_id')->index('line_area_areas_id_fk')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('area_line');
	}

}
