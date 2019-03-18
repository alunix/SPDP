<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemajuanPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemajuan_permohonans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permohonan_id')->unsigned();
             $table->integer('status_permohonan')->unsigned()->nullable();

             $table->foreign('status_permohonan')->references('status_id')->on('status_permohonans');
           
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
        Schema::dropIfExists('kemajuan_permohonans');
    }
}
