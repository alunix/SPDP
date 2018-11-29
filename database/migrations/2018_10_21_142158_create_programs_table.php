<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
           
            $table->string('lecturer_name');
            $table->string('fakulti');
            $table->string('doc_title');
            $table->string('jenis_permohonan');
            $table->string('file_name'); //To show the name of the file
            $table->string('file_link');
            $table->integer('lecturer_id')->unsigned();
            
            $table->foreign('lecturer_id')->references('id')->on('users');  

            $table->string('status_program');
           
            


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
        Schema::dropIfExists('programs');
    }
}
