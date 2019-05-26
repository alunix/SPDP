<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('notifications_id');
            $table->integer('notificationDetails')->unsigned();
            $table->string('notificationLocation');
            $table->integer('userFired')->unsigned();
            $table->integer('userToNotify')->unsigned();

            $table->foreign('userFired')->references('id')->on('users');
            $table->foreign('notificationDetails')->references('status_id')->on('status_permohonans');
            $table->foreign('userToNotify')->references('id')->on('users');
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
        Schema::dropIfExists('notifications');
    }
}
