<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Laporan;

class KemajuanPermohonanController extends Controller
{
   
    public function show($id)
    {
        $permohonan= Permohonan::find($id);
        $dp = $permohonan->dokumen_permohonans->pluck('dokumen_permohonan_id');
        $laporans= Laporan::whereIn('dokumen_permohonan_id',$dp)->get();
        
       
        return view('fakulti.kemajuan-permohonan')->with('kjs',$permohonan->kemajuan_permohonans)->with('permohonan',$permohonan)->with('dokumen_permohonans',$permohonan->dokumen_permohonans)->with('laporans',$laporans);
        
    }

   
}
