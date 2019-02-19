<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->increments('laporan_id');
            $table->integer('penilaian_id_laporan')->unsigned();
            $table->string('laporan_panel_penilai')->nullable();
            $table->string('laporan_panel_penilai_link')->nullable();
            $table->string('perakuan_pjk')->nullable();
            $table->string('perakuan_pjk_link')->nullable();
            $table->string('perakuan_jppa')->nullable();
            $table->string('perakuan_jppa_link')->nullable();
            $table->string('perakuan_senat')->nullable();
            $table->string('perakuan_senat_link')->nullable();

            $table->foreign('penilaian_id_laporan')->references('id')->on('penilaians');
          
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
        Schema::dropIfExists('laporans');
    }
}
