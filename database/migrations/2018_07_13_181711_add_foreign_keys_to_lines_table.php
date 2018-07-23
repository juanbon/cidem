<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('lines', function(Blueprint $table)
		{
			$table->foreign('financing_type_id', 'lines_financing_types_id_fk')->references('id')->on('financing_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('modality_id', 'lines_modalities_id_fk')->references('id')->on('modalities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('lines', function(Blueprint $table)
		{
			$table->dropForeign('lines_financing_types_id_fk');
			$table->dropForeign('lines_modalities_id_fk');
		});
	}

}
