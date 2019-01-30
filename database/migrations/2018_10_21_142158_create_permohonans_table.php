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
           
            // $table->string('nama_penghantar');
           
            $table->string('doc_title');
            $table->integer('jenis_permohonan_id')->unsigned();
            $table->string('file_name'); //To show the name of the file
            $table->string('file_link');
            $table->integer('id_penghantar')->unsigned();
            $table->integer('id_pjk')->unsigned()->nullable();
            $table->string('laporan_pjk')->nullable();
            $table->string('laporan_pjk_link')->nullable();

            
            $table->foreign('id_penghantar')->references('id')->on('users');
            $table->foreign('id_pjk')->references('id')->on('users');
            $table->foreign('jenis_permohonan_id')->references('id')->on('jenis_permohonans');    

            $table->string('status_permohonan');
           
            


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
