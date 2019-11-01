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

        for($i=0; $i<30; $i++){
            DB::table('permohonans')->insert([
            'doc_title' => 'Sarjana Muda '.$faker->word,
            'jenis_permohonan_id' => $faker->randomElement($j),
            'id_penghantar' => 1,
            'status_permohonan_id' => rand(1,15),
            'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
            'updated_at' =>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

        ]);
        }
        
    }
}
