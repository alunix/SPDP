<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\JenisPermohonan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SPDP\Fakulti;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $roles = ['penilai', 'pjk', 'senat', 'jppa', 'fakulti'];
        $fakultis_id = Fakulti::all()->pluck('fakulti_id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $role = $faker->randomElement($roles);
            $fakulti_id = null;
            if ($role == 'fakulti') {
                $fakulti_id = $faker->randomElement($fakultis_id);
            } 
            DB::table('users')->insert([
                'name' => $faker->firstNameMale,
                // 'role' => $role,
                'role' => $roles[0], // role is penilai
                'fakulti_id' => $fakulti_id,
                'email' => $faker->email,
                // 'api_token' => Str::random(80),
                'password' => Hash::make('popo97'),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

            ]);
        }
    }
}
