<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLineRecipientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('line_recipient', function(Blueprint $table)
		{
			$table->integer('line_id')->index('line_recipient_lines_id_fk');
			$table->integer('recipient_id')->index('line_recipient_recipients_id_fk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('line_recipient');
	}

}
