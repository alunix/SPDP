<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\JenisPermohonan;
use Illuminate\Support\Facades\Hash;
use SPDP\Permohonan;
use SPDP\User;

class PenilaianPanelTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $id = Permohonan::all()->pluck('permohonan_id')->toArray();
        $panel = User::where('role', 'penilai')->pluck('id');


        for ($i = 0; $i < 60; $i++) {
            DB::table('penilaian_panels')->insert([
                'permohonanID' => $faker->randomElement($id),
                'id_pelantik' => 2,
                'id_penilai' => $faker->randomElement($panel),
                'tarikhAkhir' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
                'tempoh' => rand(150, 180),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

            ]);
        }
    }
}
