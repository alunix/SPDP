<?php

use Faker\Generator as Faker;
use SPDP\StatusPermohonan;
use SPDP\User;
use SPDP\JenisPermohonan;

$factory->define(SPDP\Permohonan::class, function (Faker $faker) {
    
    $users_id = User::where('fakulti_id','!=',null)->pluck('id');
    $jp = JenisPermohonan::all()->pluck('id');
    $jp = JenisPermohonan::all()->pluck('id');
    $sp = StatusPermohonan::all()->pluck('status_id');

    return [
        'doc_title'=>'permohonan.pdf',
        'jenis_id'=> $faker->randomElement($jp),
        'id_penghantar'=>$faker->randomElement($users_id),
        'status_id'=>$faker->randomElement($sp),



        
    ];
});
