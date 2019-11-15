<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use SPDP\Penilaian;
use SPDP\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SPDP\Services\PermohonanClass;
use SPDP\Services\RedirectPermohonan;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Support\Collection;

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
            'fail_permohonan' => 'required|mimes:pdf|max:1999',
        ]);
    }
}
