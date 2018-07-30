<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPermissionsRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('permissions_recipients', function(Blueprint $table)
        {
            /*
            $table->foreign('user_id', 'permissions_recipients_user_id_fk')->references('id')->on('users');
            $table->foreign('recipient_id', 'permissions_recipients_recipient_id_fk')->references('id')->on('recipients');
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
        Schema::table('permissions_recipients', function(Blueprint $table)
        {   /*
            $table->dropForeign('permissions_recipients_user_id_fk');
            $table->dropForeign('permissions_recipients_recipient_id_fk');
            */
        });
    }
}
