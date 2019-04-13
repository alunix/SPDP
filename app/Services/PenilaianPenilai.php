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
use Notification;
use SPDP\Notifications\PermohonanDiluluskan;


class PenilaianPenilai
{
  
    public function uploadLaporanPenilai(Request $request,$permohonan)
    {   
        $attached= 'laporan_panel_penilai';
        
        $lc= new LaporanClass();
        $lc->createLaporan($request,$permohonan,$attached);

        /* Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan -> status_permohonan_id = 3;
        $permohonan ->save();

        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail',$penghantar->email)->notify(new PermohonanDiluluskan($permohonan,$penghantar)); //hantar email kepada penghantar

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
        'message' => 'Lampiran berjaya dimuatnaik',
        ];  
    
        return redirect('/')->with($msg);
    }

}
