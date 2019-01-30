<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;
use Illuminate\Http\Request;

class KemajuanPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \SPDP\KemajuanPermohonan  $kemajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function show(KemajuanPermohonan $kj,$id)
    {
        $permohonan= Permohonan::find($id);

        $kjs = KemajuanPermohonan::where('permohonan_id',$permohonan->id)->get();

        return view('fakulti.kemajuan-permohonan')->with('kjs',$kjs)->with('permohonan',$permohonan);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\KemajuanPermohonan  $kemajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(KemajuanPermohonan $kemajuanPermohonan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\KemajuanPermohonan  $kemajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KemajuanPermohonan $kemajuanPermohonan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\KemajuanPermohonan  $kemajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KemajuanPermohonan $kemajuanPermohonan)
    {
        //
    }
}
