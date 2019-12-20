<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\JenisPermohonan;

class PermohonansTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $j = JenisPermohonan::all()->pluck('id')->toArray();

        for ($i = 0; $i < 200; $i++) {
            $created_at = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore');
            DB::table('permohonans')->insert([
                'doc_title' => 'Sarjana Muda ' . $faker->word,
                'jenis_id' => $faker->randomElement($j),
                'id_penghantar' => 7,
                'status_id' => rand(1, 15),
                'created_at' => $created_at,
                'updated_at' => $faker->dateTimeBetween($startDate = $created_at, $endDate = 'now', $timezone = 'Singapore'),

            ]);
        }
    }
}
