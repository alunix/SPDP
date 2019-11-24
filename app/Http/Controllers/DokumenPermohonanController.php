<?php

namespace SPDP\Http\Controllers;


use Illuminate\Http\Request;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\Services\DokumenClass;
use SPDP\Services\ShowPermohonan;


class DokumenPermohonanController extends Controller
{
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $dokumens = DokumenPermohonan::with(['laporans'])->where('permohonan_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($dokumens);
    }

    public function uploadPenambahbaikkan(Request $request, $id)
    {
        $this->validate($request, [
            'dokumen' => 'required|mimes:pdf|max:1999',
        ]);

        $attached = 'dokumen';
        $permohonan = Permohonan::findOrFail($id);
        $dp = new DokumenClass();
        return $dp->update($permohonan, $request, $attached);
    }

    #API
    public function downloadDokumen($file_link)
    {
        return response(Storage::disk('local')->get('storage/cadangan_permohonan_baharu/' . $file_link), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
