<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\MuatNaikLaporan;
use SPDP\DokumenPermohonan;


class DokumenPermohonanClass 
{

    public function create($permohonan,$fileNameWithExt,$fileNameToStore)
    {   
        $dp = new DokumenPermohonan();
        $dp->permohonan_id= $permohonan->permohonan_id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link=$fileNameToStore;
        $dp->versi = 1;
        $dp->save();

        return redirect('/senarai-permohonan-dihantar')->with($msg);
    }

    
    public function update($permohonan,$fileNameWithExt,$fileNameToStore)
    {   
        $dk = DokumenPermohonan::where('permohonan_id',$permohonan->permohonan_id)->get();
        $version_count = count($dk);

        $dp = new DokumenPermohonan();
        $dp->permohonan_id= $permohonan->permohonan_id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link=$fileNameToStore;
        $dp->versi = $version_count+1;
        $dp->save();



        return redirect('/senarai-permohonan-dihantar')->with($msg);
    }



   

   
}
