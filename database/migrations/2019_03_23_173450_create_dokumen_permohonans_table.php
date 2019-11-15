<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {

            $table->increments('dokumen_permohonan_id');
            $table->integer('permohonan_id')->unsigned();
            $table->string('file_name'); //To show the name of the file
            $table->string('file_link');
            $table->integer('file_size');
            $table->string('komen')->nullable();
            $table->integer('versi');

            $table->foreign('permohonan_id')->references('permohonan_id')->on('permohonans');

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
        Schema::dropIfExists('dokumens');
    }
}
