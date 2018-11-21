<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPerakuanSenatToPenilaians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilains', function (Blueprint $table) {
            $table->string('perakuan_pjk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilains', function (Blueprint $table) {
            $table->string('perakuan_pjk')->nullable();
        });
    }
}
