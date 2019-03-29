<?php

namespace SPDP\Http\Controllers;

use SPDP\DokumenPermohonan;
use Illuminate\Http\Request;
use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use Illuminate\Support\Facades\Hash;
use SPDP\Services\PenilaianClass;
use SPDP\Services\DokumenPermohonanClass;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\PenilaianJppa;
use SPDP\Services\PenilaianSenat;
use SPDP\Services\PenilaianPenilai;

class DokumenPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permohonan= Permohonan::find($id);
        return view('fakulti.senarai-dokumen-permohonan')->with('dokumen_permohonans',$permohonan->dokumen_permohonans)->with('permohonans',$permohonan);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SPDP\DokumenPermohonan  $dokumenPermohonan
     * @return \Illuminate\Http\Response
     */
    public function showPenambahbaikkan(DokumenPermohonan $dokumenPermohonan,$id)
    {
        $permohonan = Permohonan::find($id);
        return view ('fakulti.dokumen-permohonan-penambahbaikkan')->with('permohonan',$permohonan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\DokumenPermohonan  $dokumenPermohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(DokumenPermohonan $dokumenPermohonan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\DokumenPermohonan  $dokumenPermohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DokumenPermohonan $dokumenPermohonan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\DokumenPermohonan  $dokumenPermohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DokumenPermohonan $dokumenPermohonan)
    {
        //
    }
}
