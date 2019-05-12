<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SPDP\JenisPermohonan;
use SPDP\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;++$i){
        DB::table('permohonans')->insert([
            'doc_title' => 'program_pengajian.pdf',
            'email' => Str::random(5).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        }
    }
}
