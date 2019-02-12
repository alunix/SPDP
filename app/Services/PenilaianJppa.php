<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianJppa
{
    
   

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function show(A $a)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function edit(A $a)
    {
        //
    }

    public function updatePerakuanPJK(Request $request, $id){

            $attached = 'perakuan_jppa';
            $laporan = new LaporanClass();

            $penilaian= Penilaian::find($id);
            $laporan_id= $penilaian->laporan->laporan_id;
            $laporan->uploadLaporan($request,$penilaian,$attached,$laporan_id);

           
            /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
           
            $permohonan = $penilaian->permohonan;
            /* Status semakan permohonan telah dikemaskini berdasarkan progress */
            $permohonan -> status_permohonan = 'Perakuan JPPA telah dilampirkan, permohonan akan dihantar kepada pihak Senat';
            $permohonan ->save();
            $penilaian -> save();      
            return redirect('/');

    }
    public function destroy(A $a)
    {
        //
    }
}
