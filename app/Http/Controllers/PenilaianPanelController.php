<?php

namespace SPDP\Http\Controllers;

use SPDP\PenilaianPanel;
use Illuminate\Http\Request;

class PenilaianPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penilaians = PenilaianPanel::all();
        return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
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
     * @param  \SPDP\PenilaianPanel  $penilaianPanel
     * @return \Illuminate\Http\Response
     */
    public function show(PenilaianPanel $penilaianPanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\PenilaianPanel  $penilaianPanel
     * @return \Illuminate\Http\Response
     */
    public function edit(PenilaianPanel $penilaianPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\PenilaianPanel  $penilaianPanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenilaianPanel $penilaianPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\PenilaianPanel  $penilaianPanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianPanel $penilaianPanel)
    {
        //
    }
}
