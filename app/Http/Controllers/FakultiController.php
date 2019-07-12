<?php

namespace SPDP\Http\Controllers;
use SPDP\Fakulti;
use SPDP\KemajuanPermohonan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use Illuminate\Support\Facades\Input;
use SPDP\Services\AnalitikFakulti;

class FakultiController extends Controller
{
    public function index()
    {
        return view ('fakulti.permohonan-baharu.blade.php');
    }

    public function permohonanBaru()
    {
      return view ('fakulti.permohonan-baharu');
    }
   
    public function analitik(Request $request)
    {   
        if ($request->isMethod('post'))
        {   
            $this->validate($request,[
                'year_report' => 'required|integer|min:2000',
                ]);
            $year_report= $request -> input('year_report');
        }
    
        else{
            $year_report = $request->year_report;
        }

       
        $analitik = new AnalitikFakulti();
        return $analitik->annual($request,$year_report);
    }
}
