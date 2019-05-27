<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTetapanAliranKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetapan_aliran_kerjas', function (Blueprint $table) {
            $table->increments('tetapan_id');
            $table->string('email_pjk');
            $table->string('email_jppa');
            $table->string('email_senat');
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
        Schema::dropIfExists('tetapan_aliran_kerjas');
    }
}
