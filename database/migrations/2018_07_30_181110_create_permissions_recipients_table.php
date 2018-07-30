<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
  /*      Schema::create('permissions_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
            $table->integer('modality_id')->nullable()->index('lines_modalities_id_fk');
            $table->date('dead_line')->nullable();
            $table->text('description', 65535)->nullable();
            $table->integer('financing_type_id')->nullable()->index('lines_financing_types_id_fk');

*/



        Schema::create('permissions_recipients', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->nullable()->index('permissions_recipients_user_id_fk');
            $table->integer('recipient_id')->nullable()->index('permissions_recipients_recipient_id_fk');
            $table->boolean('actions')->nullable()->default(0);
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
        Schema::dropIfExists('permissions_recipients');
    }
}
