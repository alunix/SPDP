<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Services\PermohonanClass;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\ShowPermohonan;

class PermohonanController extends Controller
{
    public function api_permohonanDihantar()
    {
        $id = auth()->guard('api')->user()->id;
        // $id = auth()->user()->id;
        $permohonans = Permohonan::with(['jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian'])
            ->where('id_penghantar', $id)->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($permohonans);
    }

    public function api_showListPermohonanBaharu()
    {
        $sp = new SenaraiPermohonan();
        return $sp->senaraiPermohonanBaru();
    }

    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $show = new ShowPermohonan();
        return $show->redirect($permohonan);
    }

    public function pelantikanPenilaiSubmit(PenilaianPJK $pp, Request $request, $id)
    {
        $this->validate($request, [
            'due_date' => 'required|after:today',
            'selectedPenilai' => 'required'
        ]);
        return $pp->pelantikanPenilaiSubmit($request, $id);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_permohonan' => 'required|integer|max:255',
            'nama_program' => 'required|string',
            'fail_permohonan' => 'required|mimes:pdf|max:1999',
        ]);
        $pc = new PermohonanClass();
        return $pc->create($request);
    }

    public function senaraiPerakuan()
    {
        $sp = new SenaraiPermohonan();
        return  $sp->senaraiPerakuan();
    }
}
