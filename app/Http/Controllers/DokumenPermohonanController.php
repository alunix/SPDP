<?php

namespace SPDP\Http\Controllers;


use Illuminate\Http\Request;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\Services\DokumenPermohonanClass;
use SPDP\Services\ShowPermohonan;


class DokumenPermohonanController extends Controller
{
    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $dokumen_permohonans = DokumenPermohonan::with(['laporans'])->where('permohonan_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($dokumen_permohonans);
    }

    public function showPenambahbaikkan($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $sp = new ShowPermohonan();
        $dp =  $sp->getBoolPermohonan($permohonan);

        if ($dp == 0) {
            abort(403, 'Tidak dibenarkan');
        } else {
            $dps = $permohonan->dokumen_permohonans;
            return view('fakulti.dokumen-permohonan-penambahbaikkan')->with('permohonan', $permohonan)->with('dps', $dps);
        }
    }

    public function uploadPenambahbaikkan(Request $request, $id)
    {
        $this->validate($request, [
            'dokumen' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::findOrFail($id);

        if ($permohonan->status_id != 8 && $permohonan->status_id != 9 && $permohonan->status_id != 10 && $permohonan->status_id != 11) {
            $msg = [
                'error' => 'Permohonan masih tidak memerlukan penambahbaikkan',
            ];
            return redirect()->route('dokumenPermohonan.penambahbaikkan.show', [$permohonan->id])->with('permohonan', $permohonan)->with('jenis_permohonan', $permohonan->jenis_permohonan)->with($msg);
            die();
        }

        $sp = new ShowPermohonan();
        $dp = $sp->getBoolPermohonan($permohonan);

        if ($dp == 0) {
            abort(403, 'Tidak dibenarkan');
        } else {
            $attached = 'dokumen';
            $permohonan = Permohonan::findOrFail($id);
            $dp = new DokumenPermohonanClass();
            $dp->update($permohonan, $request, $attached);
            $msg = [
                'message' => 'Dokumen berjaya dimuat naik',
            ];
            return redirect()->route('dokumenPermohonan.penambahbaikkan.show', [$permohonan->id])->with($msg);
        }
    }

    #API
    public function downloadDokumen($file_link)
    {
        return response(Storage::disk('local')->get('storage/cadangan_permohonan_baharu/' . $file_link), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
