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

    $msg = [
        'message' => 'Laporan berjaya dimuat naik',
       ];

       return redirect('/')->with($msg);
    }

}
