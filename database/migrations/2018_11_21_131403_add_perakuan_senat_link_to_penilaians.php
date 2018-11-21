<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPerakuanSenatLinkToPenilaians extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilains', function (Blueprint $table) {
            $table->string('perakuan_senat_link')->nullable();
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
            $table->string('perakuan_senat_link')->nullable();
        });
    }
}
