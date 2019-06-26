<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\ShowPermohonan;

class KemajuanPermohonanClass 
{
  
    public function create(Permohonan $permohonan)
    {
        $kj = new KemajuanPermohonan();
        $kj-> permohonan_id = $permohonan->permohonan_id;
        $kj-> status_permohonan= $permohonan->status_permohonan_id;
        $kj->save();
    }

    public function show($permohonan){
        $sp = new ShowPermohonan();
        $dp=  $sp->getBoolPermohonan($permohonan);

        if($dp == 0){
            abort(403,'Tidak dibenarkan');
        }
        else{
            $dp = $permohonan->dokumen_permohonans->pluck('dokumen_permohonan_id');
            $laporans= Laporan::whereIn('dokumen_permohonan_id',$dp)->get();
            return view('fakulti.kemajuan-permohonan')->with('kjs',$permohonan->kemajuan_permohonans)->with('permohonan',$permohonan)->with('dokumen_permohonans',$permohonan->dokumen_permohonans)->with('laporans',$laporans);

        }

    }

}
