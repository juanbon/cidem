<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLineRecipientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('line_recipient', function(Blueprint $table)
		{

/*

			$table->foreign('line_id', 'line_recipient_lines_id_fk')->references('id')->on('lines')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('recipient_id', 'line_recipient_recipients_id_fk')->references('id')->on('recipients')->onUpdate('RESTRICT')->onDelete('RESTRICT');

*/

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('line_recipient', function(Blueprint $table)
		{
			$table->dropForeign('line_recipient_lines_id_fk');
			$table->dropForeign('line_recipient_recipients_id_fk');
		});
	}

}

/*

alter table `line_recipient` add constraint `line_recipient_lines_id_fk` foreign key (`line_id`)
   references `lines` (`id`) on delete RESTRICT on update RESTRICT

   */