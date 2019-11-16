<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\Laporan;
use Illuminate\Http\Request;
use SPDP\Services\LaporanClass;

class LaporanController extends Controller
{
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $laporans = Laporan::with('id_penghantar_nama:id,name,role')->whereIn('dokumen_permohonan_id', $permohonan->dokumens->pluck('dokumen_permohonan_id'))->orderBy('created_at', 'desc')->paginate(5);
        return response()->json($laporans);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'kelulusan' => 'required|string',
            'laporan' => 'required|mimes:pdf|max:1999',
        ]);

        $laporan = new LaporanClass();
        return $laporan->createLaporan($id, $request);
    }
}
