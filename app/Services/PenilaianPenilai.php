<?php

namespace SPDP\Services;


use SPDP\User;
use SPDP\Services\LaporanClass;
use SPDP\Services\KemajuanPermohonanClass;
use Illuminate\Http\Request;
use Notification;
use SPDP\Notifications\PermohonanDiluluskan;
use SPDP\Notifications\LaporanDikeluarkan;
use SPDP\TetapanAliranKerja;


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

        $panel = auth()->user();
        $id_pjk = TetapanAliranKerja::all()->first()->id_pjk;
        $pjk= User::find($id_pjk);
        Notification::route('mail',$pjk->email)->notify(new LaporanDikeluarkan($permohonan,$pjk,$panel)); 
        

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
        'message' => 'Lampiran berjaya dimuatnaik',
        ];  
    
        return redirect('/')->with($msg);
    }

}
