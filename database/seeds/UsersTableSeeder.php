<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\JenisPermohonan;
use Illuminate\Support\Facades\Hash;
use SPDP\Fakulti;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $roles = ['penilai', 'pjk', 'senat', 'jppa'];
        $fakultis_id = Fakulti::all()->pluck('fakulti_id')->toArray();

        for ($i = 0; $i < 60; $i++) {
            // $role = $faker->randomElement($roles);
            // if ($role == 'fakulti') {
            //     $fakulti_id = $faker->randomElement($fakultis_id);
            // } else {
            //     $fakulti_id = "";
            // }
            DB::table('users')->insert([
                'name' => $faker->firstNameMale,
                'role' => $faker->randomElement($roles),
                // 'fakulti_id' => $fakulti_id,
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

            ]);
        }
    }
}
