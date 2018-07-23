<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('institucion')->nullable();
			$table->integer('modality_id')->nullable()->index('lines_modalities_id_fk');
			$table->date('dead_line')->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('financing_type_id')->nullable()->index('lines_financing_types_id_fk');
			$table->string('web')->nullable();
			$table->timestamps();
			$table->text('info', 65535)->nullable();
			$table->boolean('is_enabled')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lines');
	}

}
