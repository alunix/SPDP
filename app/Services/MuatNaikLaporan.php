<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\PermohonanClass;

class MuatNaikLaporan
{
   
    public function create(Permohonan $permohonan)
    {
        $kj = new KemajuanPermohonan();
        $kj-> permohonan_id = $permohonan->id;
        $kj-> status_permohonan= $permohonan->status_permohonan;
        $kj->save();
    }

    
}
