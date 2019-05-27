<?php

namespace SPDP\Http\Controllers;

use SPDP\TetapanAliranKerja;
use Illuminate\Http\Request;
use SPDP\User;

class TetapanAliranKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tetapan = TetapanAliranKerja::all()->first();
        return view ('pjk.tetapan-aliran-kerja')->with('setting',$tetapan);
    }

   
   
    public function update(Request $request)
    {
        $tetapan = TetapanAliranKerja::find(1);

        $tetapan->email_pjk = $request->get('email_pjk');
        $tetapan->email_jppa = $request->get('email_jppa');
        $tetapan->email_senat = $request->get('email_senat');
        $tetapan->save();

        $msg = [
            'message' => 'Tetapan aliran kerja berjaya dikemaskini',
           ];

        return redirect()->route('aliranKerja.settings.show')->with('setting',$tetapan)->with($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\TetapanAliranKerja  $tetapanAliranKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(TetapanAliranKerja $tetapanAliranKerja)
    {
        //
    }
}
