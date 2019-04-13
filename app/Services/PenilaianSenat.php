<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;



class PenilaianSenat
{ 
    public function uploadPerakuanSenat(Request $request, $id){

        /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $penilaian= Penilaian::find($id);

        $attached = 'perakuan_senat';
        $laporan = new LaporanClass();
        $laporan_id= $penilaian->laporan->laporan_id;
        $laporan->uploadLaporan( $request,$penilaian,$attached,$laporan_id);
       
        $permohonan = $penilaian->permohonan;
        /* Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan -> status_permohonan_id = 6;       
        $permohonan ->save();
        $penilaian -> save();

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Perakuan berjaya dimuatnaik',
           ];  

        return redirect('/')->with($msg);

    }
    
}
