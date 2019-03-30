<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_panels', function (Blueprint $table) {
            $table->increments('laporan_panel_id');
            $table->integer('dokumen_permohonan_id')->unsigned();
            $table->string('tajuk_fail');
            $table->string('tajuk_fail_link');
            $table->integer('versi_permohonan_dokumen');

            $table->foreign('dokumen_permohonan_id')->references('dokumen_permohonan_id')->on('dokumen_permohonans');
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
        Schema::dropIfExists('laporan_panels');
    }
}
