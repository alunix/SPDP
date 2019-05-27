<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use SPDP\Permohonan;
use SPDP\TetapanAliranKerja;
use SPDP\Notifications\PermohonanBaharu;
use SPDP\Notifications\PermohonanDiluluskan;
use SPDP\User;
use Notification;



class PenilaianSenat
{ 
    public function uploadPerakuanSenat(Request $request, $id){

        /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $permohonan= Permohonan::find($id);

        $attached = 'perakuan_senat';
        $laporan = new LaporanClass();
        $laporan->createLaporan( $request,$permohonan,$attached);
       
        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail',$penghantar->email)->notify(new PermohonanDiluluskan($permohonan,$penghantar)); //hantar email kepada penghantar

        /* Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan -> status_permohonan_id = 6;       
        $permohonan ->save();
       

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Perakuan berjaya dimuatnaik',
           ];  

        return redirect()->route('home')->with($msg);

    }

    public function showPerakuanSenat($permohonan){

        return view ('senat.lampiran-perakuan-senat')->with('permohonan',$permohonan);



    }
    
}
