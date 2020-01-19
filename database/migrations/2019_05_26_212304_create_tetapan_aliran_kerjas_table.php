<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use SPDP\User;

class CreateTetapanAliranKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetapan_aliran_kerjas', function (Blueprint $table) {
            $table->increments('tetapan_id');
            $table->integer('id_pjk')->unsigned();
            $table->integer('id_jppa')->unsigned();
            $table->integer('id_senat')->unsigned();

            $table->foreign('id_pjk')->references('id')->on('users');
            $table->foreign('id_jppa')->references('id')->on('users');
            $table->foreign('id_senat')->references('id')->on('users');

            $table->timestamps();
        });

        $pjk = User::where('role', 'pjk')->first();
        $jppa = User::where('role', 'jppa')->first();
        $senat = User::where('role', 'senat')->first();

        DB::table('tetapan_aliran_kerjas')->insert(
            [
                [
                    'id_pjk' => $pjk->id,
                    'id_jppa' => $jppa->id,
                    'id_senat' => $senat->id,
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tetapan_aliran_kerjas');
    }
}
