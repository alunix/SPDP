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
        $pjks = User::where('role','pjk')->get();
        $jppas = User::where('role','jppa')->get();
        $senats =User::where('role','senat')->get();

        $selectedPjk =$tetapan->value('id_pjk');
        $selectedJppa =$tetapan->value('id_jppa');
        $selectedSenat =$tetapan->value('id_senat');

       

        return view ('pjk.tetapan-aliran-kerja')->with('setting',$tetapan)->with('pjks',$pjks)->with('jppas',$jppas)->with('senats',$senats)->with('selectedPjk',$selectedPjk)->with('selectedJppa',$selectedJppa)->with('selectedSenat',$selectedSenat);
    }

   
   
    public function update(Request $request)
    {
        $tetapan = TetapanAliranKerja::all()->first();
        $tetapan->id_pjk = $request->get('id_pjk');
        $tetapan->id_jppa = $request->get('id_jppa');
        $tetapan->id_senat = $request->get('id_senat');
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
