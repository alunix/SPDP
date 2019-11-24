<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonans', function (Blueprint $table) {


            $table->increments('id');
            $table->string('doc_title');
            $table->integer('jenis_id')->unsigned();
            // $table->integer('dokumen_permohonan_id')->unsigned();
            $table->integer('id_penghantar')->unsigned();
            $table->integer('status_id')->unsigned();

            $table->foreign('id_penghantar')->references('id')->on('users');
            $table->foreign('jenis_id')->references('id')->on('jenis_permohonans');
            $table->foreign('status_id')->references('status_id')->on('status_permohonans');
            // $table->foreign('dokumen_permohohonan_id')->references('dokumen_permohonan_id')->on('dokumens');  

            $table->timestamps();
        });

        // Schema::table('priorities', function($table) {
        //     $table->foreign('lecturer_id')->references('id')->on('users');  
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonans');
    }
}
