<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermohonansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
    {   
        for($i=0; $i<80; $i++){
            DB::table('permohonans')->insert([
            'doc_title' => 'Sarjana Muda Buku',
            'jenis_permohonan_id' => 1,
            'id_penghantar' => 1,
            'status_permohonan_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        }
        
    }
}
