<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use SPDP\JenisPermohonan;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $role = ['penilai', 'fakulti', 'pjk', 'senat', 'jppa'];

        for ($i = 0; $i < 60; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstNameMale,
                'role' => $faker->randomElement($role),
                'email' => $faker->freeEmail,
                'password' => Hash::make($faker->password),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),
                'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = 'Singapore'),

            ]);
        }
    }
}
