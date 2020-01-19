<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SPDP\Fakulti;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('fakulti_id')->nullable()->unsigned();
            
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('fakulti_id')->references('fakulti_id')->on('fakultis');
        });

        // $ftsm_id = Fakulti::where('kod', 'ftsm')->first()->value('fakulti_id');

        DB::table('users')->insert(
            [
                [
                    'name' => 'Dalbir Singh',
                    'role' => 'pjk',
                    'email' => 'dalbir@gmail.com',
                    'password' => Hash::make('popo97'),
                    'fakulti_id' => null,
                    'email_verified_at' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Fakulti',
                    'role' => 'fakulti',
                    'email' => 'fakulti@gmail.com',
                    'password' => Hash::make('popo97'),
                    'fakulti_id' => 12,
                    'email_verified_at' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
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
        Schema::dropIfExists('users');
    }
}
