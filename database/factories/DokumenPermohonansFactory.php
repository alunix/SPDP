<?php

use Faker\Generator as Faker;
use SPDP\StatusPermohonan;
use SPDP\User;
use SPDP\JenisPermohonan;
use SPDP\Permohonan;

$factory->define(SPDP\DokumenPermohonan::class, function (Faker $faker) {
   
    $permohonans_id = Permohonan::all()->pluck('id');
   

    return [

        'permohonan_id'=>$faker->randomELement($permohonans_id),
        'file_name'=>'permohonan.pdf',
        'file_link'=>'permohonan45634.pdf',
        'file_size'=>123,
        'komen'=> null,
        'versi'=>rand(1,8),
        'created_at'=> $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = 'Asia/Kuala_Lumpur')

        
    ];
});
