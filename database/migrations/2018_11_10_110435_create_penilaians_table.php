<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('dokumen_id')->unsigned()->unique();
            $table->integer('penilaian_pjk')->unsigned()->nullable();;
            $table->integer('penilaian_panel_1')->unsigned()->nullable();
            $table->integer('penilaian_jppa')->unsigned()->nullable();
            $table->integer('penilaian_senat')->unsigned()->nullable();
            $table->integer('status_penilaian');


            // $table->foreign('dokumen_id')->references('id')->on('permohonans');
            $table->foreign('penilaian_pjk')->references('id')->on('users');
            $table->foreign('penilaian_panel_1')->references('id')->on('users');
            $table->foreign('penilaian_jppa')->references('id')->on('users');
            $table->foreign('penilaian_senat')->references('id')->on('users');

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
        Schema::dropIfExists('penilaians');
    }
}
