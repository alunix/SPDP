<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\Permohonan;
use SPDP\JenisPermohonan;
use SPDP\StatusPermohonan;

class KemajuansTableSeeder extends Seeder
{
    public function run() {
        $faker = Faker::create();
        $p = Permohonan::all()->pluck('id')->toArray();
        $s = StatusPermohonan::all()->pluck('status_id')->toArray();

        for($i=0; $i<1000; $i++) {
            DB::table('kemajuan_permohonans')->insert([
            'permohonan_id' =>  $faker->randomElement($p),
            'status_id' => $faker->randomElement($s),
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
            'updated_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = 'Singapore'),
        ]);
        }
    }
}
