<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateJenisPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_permohonans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kod');
            $table->string('huraian');
            $table->timestamps();
        });

        DB::table('jenis_permohonans')->insert(
            [
                [
                    'kod' => 'program_baharu',
                    'huraian' => 'Program Pengajian Baharu',
                ],
                [
                    'kod' => 'semakan_program',
                    'huraian' => 'Semakan Program Pengajian',
                ],
                [
                    'kod' => 'kursus_teras_baharu',
                    'huraian' => 'Kursus Teras Baharu',
                ],
                [
                    'kod' => 'kursus_elektif_baharu',
                    'huraian' => 'Kursus Elektif Baharu',
                ],
                [
                    'kod' => 'semakan_kursus_teras',
                    'huraian' => 'Semakan Kursus Teras',
                ],
                [
                    'kod' => 'semakan_kursus_elektif',
                    'huraian' => 'Semakan Kursus Elektif',
                ],
                [
                    'kod' => 'akreditasi_penuh',
                    'huraian' => 'Akreditasi Penuh/Audit Pemantauan',
                ],
                [
                    'kod' => 'penjumudan_program',
                    'huraian' => 'Penjumudan Program Pengajian',
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
        Schema::dropIfExists('jenis_permohonans');
    }
}
