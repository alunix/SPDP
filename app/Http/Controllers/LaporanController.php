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

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan::all();


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
     * @param  \SPDP\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dp = DokumenPermohonan::find($id);
        return view ('fakulti.senarai-laporan-dokumen-permohonan')->with('dokumen_permohonan',$dp)->with('laporans',$dp->laporans);
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
