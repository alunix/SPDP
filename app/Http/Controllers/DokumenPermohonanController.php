<?php

namespace SPDP\Http\Controllers;


use Illuminate\Http\Request;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\Services\DokumenPermohonanClass;
use SPDP\Services\ShowPermohonan;


class DokumenPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permohonan = Permohonan::find($id);
        $sp = new ShowPermohonan();
        $dp = $sp->getBoolPermohonan($permohonan);
        if ($dp == 0) {
            abort(403, 'Tidak dibenarkan');
        } else {
            // return view('fakulti.senarai-dokumen-permohonan')->with('dokumen_permohonans', $permohonan->dokumen_permohonans)->with('permohonan', $permohonan);
            $dp = $permohonan->dokumen_permohonans;
            return response()->json(['permohonan' => $permohonan, 'dokumen_permohonans' => $dp]);
        }
    }

    public function showPenambahbaikkan($id)
    {
        $permohonan = Permohonan::find($id);

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

        $permohonan = Permohonan::find($id);

        if ($permohonan->status_permohonan_id != 8 && $permohonan->status_permohonan_id != 9 && $permohonan->status_permohonan_id != 10 && $permohonan->status_permohonan_id != 11) {

            $msg = [
                'error' => 'Permohonan masih tidak memerlukan penambahbaikkan',
            ];

            return redirect()->route('dokumenPermohonan.penambahbaikkan.show', [$permohonan->permohonan_id])->with('permohonan', $permohonan)->with('jenis_permohonan', $permohonan->jenis_permohonan)->with($msg);
            die();
        }

        $sp = new ShowPermohonan();
        $dp = $sp->getBoolPermohonan($permohonan);

        if ($dp == 0) {
            abort(403, 'Tidak dibenarkan');
        } else {
            $attached = 'dokumen';
            $permohonan = Permohonan::find($id);


            $dp = new DokumenPermohonanClass();
            $dp->update($permohonan, $request, $attached);

            $msg = [
                'message' => 'Dokumen berjaya dimuat naik',
            ];

            return redirect()->route('dokumenPermohonan.penambahbaikkan.show', [$permohonan->permohonan_id])->with($msg);
        }
    }
}
