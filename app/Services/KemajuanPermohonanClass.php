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
    public function create(Permohonan $permohonan) {
        $kj = new KemajuanPermohonan();
        $kj->permohonan_id = $permohonan->permohonan_id;
        $kj->status_permohonan = $permohonan->status_permohonan_id;
        $kj->save();
    }

    public function show($permohonan) {
        $sp = new ShowPermohonan();
        $dp =  $sp->getBoolPermohonan($permohonan);
        $permohonan = Permohonan::where('permohonan_id', $permohonan->permohonan_id )
        ->with(['dokumen_permohonans.laporans.id_penghantar_nama', 'laporans.id_penghantar_nama', 'kemajuan_permohonans.statusPermohonan' ])->get();

        if ($dp == 0) {
            abort(403, 'Tidak dibenarkan');
        } else {
           return response()->json(['laporans' => $permohonan[0]->laporans, 'kemajuans' => $permohonan[0]->kemajuan_permohonans, 'permohonan' => $permohonan[0], 'dokumens' => $permohonan[0]->dokumen_permohonans]);

        }
    }
}
