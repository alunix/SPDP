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
            
            
            $table->increments('permohonan_id');
            $table->string('doc_title');
            $table->integer('jenis_permohonan_id')->unsigned();
            $table->integer('dokumen_permohonan_id')->unsigned();
            $table->integer('id_penghantar')->unsigned();
            $table->integer('status_permohonan_id')->unsigned();

            $table->foreign('id_penghantar')->references('id')->on('users');
            $table->foreign('id_pjk')->references('id')->on('users');
            $table->foreign('jenis_permohonan_id')->references('id')->on('jenis_permohonans');
            $table->foreign('status_permohonan_id')->references('status_id')->on('status_permohonans');
            $table->foreign('dokumen_permohohonan_id')->references('dokumen_permohonan_id')->on('dokumen_permohonans');  

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
