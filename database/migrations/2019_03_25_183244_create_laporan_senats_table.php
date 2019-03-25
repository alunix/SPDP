<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanSenatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_senats', function (Blueprint $table) {
            $table->increments('laporan_senat_id');
            $table->integer('permohonan_id_laporan')->unsigned();
            $table->string('tajuk_fail');
            $table->string('tajuk_fail_link');
            $table->integer('versi_permohonan_dokumen');

            $table->foreign('permohonan_id_laporan')->references('permohonan_id')->on('permohonans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_senats');
    }
}
