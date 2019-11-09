<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_panels', function (Blueprint $table) {
            $table->increments('penilaian_id');
            $table->integer('permohonanID')->unsigned();
            $table->integer('id_pelantik')->unsigned();
            $table->integer('id_penilai')->unsigned();
            $table->dateTime('due_date');
            $table->integer('tempoh');

            $table->foreign('permohonanID')->references('permohonan_id')->on('permohonans');
            $table->foreign('id_pelantik')->references('id')->on('users');
            $table->foreign('id_penilai')->references('id')->on('users');
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
        Schema::dropIfExists('penilaian_panels');
    }
}
