<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStatusPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_permohonans', function (Blueprint $table) {
            $table->increments('status_id');
            $table->string('huraian');
            $table->timestamps();
        });

        DB::table('status_permohonans')->insert(
            [
                [
                    'huraian' => 'Belum disemak',
                ],
                [
                    'huraian' => 'Diluluskan oleh PJK, permohonan akan disemak oleh panel penilai',
                ],
                [
                    'huraian' => 'Diluluskan oleh panel penilai',
                ],
                [
                    'huraian' => 'Perakuan PJK telah dimuat naik, permohonan akan disemak oleh JPPA',
                ],
                [
                    'huraian' => 'Diluluskan oleh JPPA, permohonan akan disemak oleh pihak Senat',
                ],
                [
                    'huraian' => 'Diluluskan oleh Senat, permohonan telah diluluskan sepenuhnya',
                ],
                [
                    'huraian' => 'Perakuan PJK telah dimuat naik, permohonan diluluskan sepenuhnya ',
                ],
                [
                    'huraian' => 'Perlu penambahbaikkan (Panel Penilai)',
                ],
                [
                    'huraian' => 'Perlu penambahbaikkan (PJK)',
                ],
                [
                    'huraian' => 'Perlu penambahbaikkan (JPPA)',
                ],
                [
                    'huraian' => 'Perlu penambahbaikkan (Senat)',
                ],
                [
                    'huraian' => 'Dokumen penambahbaikkan telah dimuat naik (Panel Penilai)',
                ],
                [
                    'huraian' => 'Dokumen penambahbaikkan telah dimuat naik (PJK)',
                ],
                [
                    'huraian' => 'Dokumen penambahbaikkan telah dimuat naik (JPPA)',
                ],
                [
                    'huraian' => 'Dokumen penambahbaikkan telah dimuat naik (Senat)',
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
        Schema::dropIfExists('status_permohonans');
    }
}
