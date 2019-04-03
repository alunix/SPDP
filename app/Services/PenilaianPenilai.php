<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use SPDP\Services\KemajuanPermohonanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianPenilai
{
  
    public function uploadLaporanPenilai(Request $request,$permohonan)
    {   
        
       
        $attached= 'laporan_panel_penilai';
        
        $lc= new LaporanClass();
        // $lc->createLaporan($request,$penilaian,$attached);
        $lc->createLaporan($request,$permohonan,$attached);
    
        /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $penilaian = $permohonan->penilaian;

        /* Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan -> status_permohonan_id = 3;
        $permohonan ->save();

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
        'message' => 'Lampiran berjaya dimuatnaik',
        ];  
    
    return redirect('/')->with($msg);
    }

}
