<?php

namespace SPDP\Http\Controllers;

use SPDP\Penilaian;
use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\PenilaianJppa;
use SPDP\Services\PenilaianSenat;
use SPDP\Services\PenilaianPenilai;

class PenilaianController extends Controller
{

    public function showPerakuanPjk($id)
    {
        $pp = new PenilaianPJK();
        return $pp->showPerakuanPjk($id);
    }

    public function uploadPerakuanPjk(Request $request, $id)
    {
        $this->validate($request, [
            'perakuan_pjk' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        $penilaian = new PenilaianPJK();
        return $penilaian->uploadPerakuanPjk($request, $permohonan);
    }



    public function uploadPerakuanJppa(Request $request, $id)
    {

        $this->validate($request, [
            'perakuan_jppa' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        $pj = new PenilaianJppa();
        return $pj->uploadPerakuan($request, $permohonan);
    }

    public function showLaporanPenilai($id)
    {
        $permohonan = Permohonan::find($id);
        return view('panel_penilai.panel-lulus-permohonan')->with('permohonan', $permohonan);
    }


    public function uploadLaporanPenilai(PenilaianPenilai $pp, Request $request, $id)
    {
        $this->validate($request, [
            'laporan_panel_penilai' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        return $pp->uploadLaporanPenilai($request, $permohonan);
    }

    public function showPerakuanSenat($id)
    {
        $pp = new PenilaianSenat();
        $permohonan = Permohonan::find($id);
        return $pp->showPerakuanSenat($permohonan);
    }

    public function uploadPerakuanSenat(Request $request, $id)
    {

        $this->validate($request, [
            'perakuan_senat' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        $pc = new PenilaianSenat();
        return $pc->uploadPerakuanSenat($request, $permohonan);
    }
}
