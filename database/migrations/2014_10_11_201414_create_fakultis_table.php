<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFakultisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakultis', function (Blueprint $table) {
            $table->increments('fakulti_id');
            $table->string('f_nama');
            $table->string('kod');
            $table->timestamps();
        });

        DB::table('fakultis')->insert(
            [
                [
                    'f_nama' => 'Fakulti Sains Sosial dan Kemanusiaan',
                    'kod' => 'FSSK',
                ],
                [
                    'f_nama' => 'Fakulti Sains dan Teknologi',
                    'kod' => 'FST',
                ],
                [
                    'f_nama' => 'Fakulti Ekonomi dan Pengurusan',
                    'kod' => 'FEP',
                ],
                [
                    'f_nama' => 'Fakulti Farmasi',
                    'kod' => 'FARMASI',
                ],
                [
                    'f_nama' => 'Fakulti Pengajian Islam',
                    'kod' => 'FPI',
                ],
                [
                    'f_nama' => 'Fakulti Sains Kesihatan',
                    'kod' => 'FSK',
                ],
                [
                    'f_nama' => 'Fakulti Kejuruteraan dan Alam Bina',
                    'kod' => 'FKAB',
                ],
                [
                    'f_nama' => 'Fakulti Undang-Undang',
                    'kod' => 'FUU',
                ],
                [
                    'f_nama' => 'Fakulti Pergigian',
                    'kod' => 'FPERG',
                ],
                [
                    'f_nama' => 'Fakulti Pendidikan',
                    'kod' => 'FPEND',
                ],
                [
                    'f_nama' => 'Fakulti Perubatan',
                    'kod' => 'FPER',
                ],
                [
                    'f_nama' => 'Fakulti Teknologi dan Sains Maklumat',
                    'kod' => 'FTSM',
                ],
                [
                    'f_nama' => 'UKM-GSB Pusat Pengajian Siswazah Perniagaan',
                    'kod' => 'GSB',
                ]
            ]

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakultis');
    }
}
