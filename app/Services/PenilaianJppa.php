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
    public function uploadPerakuan(Request $request, $permohonan) {

        $jp =$permohonan->jenis_id;
        
        if($jp!=8) {

        /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $attached = 'perakuan_jppa';
        $laporan = new LaporanClass();
        $laporan->createLaporan( $request,$permohonan,$attached);

        /* Update status */
        $permohonan -> status_permohonan_id = 5;       
        $permohonan ->save();

        $id_senat = TetapanAliranKerja::all()->first()->id_senat;
        $senat = User::findOrFail($id_senat);
        Notification::route('mail',$senat->email)->notify(new PermohonanBaharu($permohonan,$senat));
        $penghantar = User::findOrFail($permohonan->id_penghantar);
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

    public function penjumudanProgram($request,$permohonan) {
        $attached = 'perakuan_jppa';
        $laporan = new LaporanClass();
        $laporan->createLaporan($request,$permohonan,$attached);
        
        $permohonan=Permohonan::find($permohonan->id);
        $sp = new StatusPermohonanClass();
        $permohonan->status_permohonan_id = 5;
        $permohonan->save();

        $kj = new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $id_senat = TetapanAliranKerja::all()->first()->id_senat;
        $senat = User::find($id_senat);
        Notification::route('mail',$senat->email)->notify(new PermohonanBaharu($permohonan,$senat)); 

        $msg = [
            'message' => 'Laporan berjaya dimuat naik',
        ];

        return redirect('/')->with($msg);
    }

}
