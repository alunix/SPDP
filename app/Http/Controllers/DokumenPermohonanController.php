<?php

namespace SPDP\Http\Controllers;


use Illuminate\Http\Request;
use SPDP\Permohonan;
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
        $permohonan= Permohonan::find($id);
        return view('fakulti.senarai-dokumen-permohonan')->with('dokumen_permohonans',$permohonan->dokumen_permohonans)->with('permohonan',$permohonan);

    }
     
    public function showPenambahbaikkan($id)
    {
        $permohonan = Permohonan::find($id);

        $sp = new ShowPermohonan();
        $dp=  $sp->getBoolPermohonan($permohonan);

        if($dp == 0){
            abort(403,'Tidak dibenarkan');
        }
        else{
            $dps= $permohonan->dokumen_permohonans;
            return view ('fakulti.dokumen-permohonan-penambahbaikkan')->with('permohonan',$permohonan)->with('dps',$dps);
        }


       
    }

    public function uploadPenambahbaikkan(Request $request,$id)
    {
        $permohonan = Permohonan::find($id);
        $this->validate($request,[
            'dokumen' => 'required|file|max:1999',
        ]);
       
        $attached = 'dokumen';
        $permohonan = Permohonan::find($id);
        

        $dp = new DokumenPermohonanClass();
        $dp->update($permohonan,$request,$attached);

        $msg = [
            'message' => 'Dokumen berjaya dimuat naik',
           ];  

        return redirect()->route('dokumenPermohonan.penambahbaikkan.show', [$permohonan->permohonan_id])->with($msg);
        


    }
}
