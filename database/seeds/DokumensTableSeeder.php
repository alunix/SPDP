<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\Permohonan;
use SPDP\JenisPermohonan;

class DokumensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker::create();
        $p = Permohonan::all()->pluck('id')->toArray();
        $j = JenisPermohonan::all()->pluck('id')->toArray();

        for($i=0; $i<1000; $i++){
            DB::table('dokumen_permohonans')->insert([
            'permohonan_id' =>  $faker->randomElement($p),
            'file_name' => 'CadanganSarjanaMuda.pdf',
            'file_link' => 'CadanganSarjanaMuda_4324253132.pdf',
            'file_size' => rand(60,180),
            'komen' => $faker->sentence,
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
            'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

        ]);
        }
    }
}
