<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;

class KemajuanPermohonanController extends Controller
{
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $kemajuan = KemajuanPermohonan::with('statusPermohonan:status_id,huraian')->where('permohonan_id', $permohonan->id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($kemajuan);
    }
}
