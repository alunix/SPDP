<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Laporan;
use SPDP\Services\ShowPermohonan;
use SPDP\Services\KemajuanPermohonanClass;

class KemajuanPermohonanController extends Controller
{   
    public function show($id)
    {       
        $permohonan= Permohonan::findOrFail($id);
        $kemajuan = KemajuanPermohonan::with('statusPermohonan:status_id,huraian')->where('permohonan_id', $permohonan->permohonan_id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($kemajuan);
    }

   
}
