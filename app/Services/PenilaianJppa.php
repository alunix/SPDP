<?php

namespace SPDP\Services;


use SPDP\Permohonan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use SPDP\TetapanAliranKerja;
use SPDP\Notifications\PermohonanBaharu;
use SPDP\Notifications\PermohonanDiluluskan;
use SPDP\User;
use Notification;


class PenilaianJppa
{

    public function uploadPerakuan(Request $request, $permohonan){

        $jp =$permohonan->jenis_permohonan_id;
        
        if($jp!=8){

        /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $attached = 'perakuan_jppa';
        $laporan = new LaporanClass();
       
        $laporan->createLaporan( $request,$permohonan,$attached);
    
    
        /* Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan -> status_permohonan_id = 5;       
        $permohonan ->save();

        $email = TetapanAliranKerja::all()->first()->email_senat;
        $pemeriksa = User::where('email',$email)->first();
        Notification::route('mail',$pemeriksa->email)->notify(new PermohonanBaharu($permohonan,$pemeriksa)); 

        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail',$penghantar->email)->notify(new PermohonanDiluluskan($permohonan,$penghantar)); //hantar email kepada penghantar
      

        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Perakuan berjaya dimuatnaik',
        ];  

        return redirect('/')->with($msg);
    }
        else    
            return $this->penjumudanProgram($request,$permohonan);

    }

    public function penjumudanProgram($request,$permohonan){

    $penilaian = new PenilaianClass();
    $penilaian = $penilaian->create($permohonan);
    $attached = 'perakuan_jppa';
    $laporan = new LaporanClass();
    $laporan->createLaporan($request,$penilaian,$attached);

    
    $permohonan=Permohonan::find($permohonan->id);
    $sp = new StatusPermohonanClass();
    $permohonan->status_permohonan_id=5;
    $permohonan->save();

    $kj = new KemajuanPermohonanClass();
    $kj->create($permohonan);

    $email = TetapanAliranKerja::all()->first()->email_senat;

    return $email;
    $pemeriksa = User::where('email',$email)->first();
    Notification::route('mail',$pemeriksa->email)->notify(new PermohonanBaharu($permohonan,$pemeriksa)); 

    $msg = [
        'message' => 'Laporan berjaya dimuat naik',
       ];

       return redirect('/')->with($msg);
    }

}
