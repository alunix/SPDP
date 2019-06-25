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
            $table->integer('id_pjk')->unsigned();
            $table->integer('id_jppa')->unsigned();
            $table->integer('id_senat')->unsigned();

            $table->foreign('id_pjk')->references('id')->on('users');
            $table->foreign('id_jppa')->references('id')->on('users');
            $table->foreign('id_senat')->references('id')->on('users');

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
