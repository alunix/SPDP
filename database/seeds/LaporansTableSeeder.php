<?php

use Illuminate\Database\Seeder;
use SPDP\Permohonan;
use SPDP\JenisPermohonan;
use Carbon\Carbon;
use SPDP\DokumenPermohonan;
use SPDP\User;
use Faker\Factory as Faker;

class LaporansTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $p = Permohonan::all()->pluck('id')->toArray();
        $j = JenisPermohonan::all()->pluck('id')->toArray();
        $d = DokumenPermohonan::all()->pluck('dokumen_permohonan_id')->toArray();
        $role = User::where('role', '!=', 'fakulti')->pluck('id')->toArray();

        for($i=0; $i<4000; $i++){
            DB::table('laporans')->insert([
            'dokumen_permohonan_id' =>  $faker->randomElement($d),
            'id_penghantar' => $faker->randomElement($role),
            'tajuk_fail' => $faker->word.'_'.rand(10000, 1000000).'.pdf',
            'tajuk_fail_link' => 'Laporan '.$faker->word,
            'komen' => $faker->sentence,
            'versi' => rand(1,10),
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
            'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

        ]);
        }
    }
}
