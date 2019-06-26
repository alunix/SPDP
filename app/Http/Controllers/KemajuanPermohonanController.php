<?php

namespace SPDP\Http\Controllers;

use SPDP\KemajuanPermohonan;
use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Laporan;
use SPDP\Services\ShowPermohonan;
use SPDP\Services\KemajuanPermohonanClass;

class KemajuanPermohonanController extends Controller
{
   
    public function show($id)
    {       
        $kp = new KemajuanPermohonanClass();
        $permohonan= Permohonan::find($id);

        if($permohonan==null)
            abort(404);
        else
        return $kp->show($permohonan);
        
    }

   
}
