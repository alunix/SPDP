<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use Illuminate\Http\Request;
use SPDP\Services\PermohonanClass;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\SenaraiPerakuan;
use SPDP\Services\ShowPermohonan;
use Redirect, Response;

class PermohonanController extends Controller
{
    public function permohonanDihantar()
    {
        return view('fakulti.senarai_permohonan_dihantar');
    }

    public function showListPermohonanBaharu()
    {
        return view('pjk.pjk-view-permohonan-baharu');
    }

    public function senaraiPerakuan()
    {
        $sp = new SenaraiPerakuan();
        return  $sp->senaraiPerakuan();
    }

    public function permohonanTidakDilulus(Request $request, $id)
    {
        $permohonan = Permohonan::find($id);
        return view('laporan.permohonan-tidak-dilulus')->with('permohonan', $permohonan)->with('jenis_permohonan', $permohonan->jenis_permohonan);
    }

    public function storePermohonanTidakDilulus(Request $request, $id)
    {
        $this->validate($request, [
            'dokumen' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        $pc = new PermohonanClass();
        $pc->storePermohonanTidakDilulus($request, $permohonan->permohonan_id);
        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_permohonan_id' => 'required|integer|max:255',
            'doc_title' => 'required|string',
            'file_link' => 'required|mimes:pdf|max:1999',
        ]);
        $pc = new PermohonanClass();
        return $permohonan = $pc->create($request);
    }

    public function  showPelantikanPenilai($id)
    {
        $permohonan = Permohonan::find($id);
        $users = User::where('role', 'penilai')->get();
        $dp = DokumenPermohonan::where('permohonan_id', $permohonan->permohonan_id)->orderBy('versi', 'DESC')->first();
        return view('pjk.pjk-melantik-penilai')->with('users', $users)->with('permohonan', $permohonan)->with('dp', $dp);
    }

    public function pelantikanPenilaiSubmit(PenilaianPJK $pp, Request $request, $id)
    {
        $this->validate($request, [
            'checked' => 'required',
        ]);
        return $pp->pelantikanPenilaiSubmit($request, $id);
    }

    /*API START  */
    public function api_permohonanDihantar()
    {
        $id = auth()->user()->id;
        $permohonans = Permohonan::with(['jenis_permohonan:id,jenis_permohonan_huraian', 'status_permohonan:status_id,status_permohonan_huraian'])
            ->where('id_penghantar', $id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($permohonans);
    }

    public function api_showListPermohonanBaharu()
    {
        $sp = new SenaraiPermohonan();
        return  $sp->index();
    }

    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $show = new ShowPermohonan();
        return $show->show($permohonan);
    }
}
