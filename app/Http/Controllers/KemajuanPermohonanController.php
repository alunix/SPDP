<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;
use Illuminate\Http\Request;

class KemajuanPermohonanController extends Controller
{
   
    public function show(KemajuanPermohonan $kj,$id)
    {
        $permohonan= Permohonan::find($id);
        return view('fakulti.kemajuan-permohonan')->with('kjs',$permohonan->kemajuan_permohonans)->with('permohonan',$permohonan)->with('dokumen_permohonans',$permohonan->dokumen_permohonans);

    }

   
}
