<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Charts;
use SPDP\Services\AnalitikFakulti;
use SPDP\Services\Analitik;
use Illuminate\Support\Facades\Input;


class ChartController extends Controller
{

public function dashboard(){

    $role = auth()->user()->role;

    switch ($role) {
        case 'fakulti':
        $analitik = new AnalitikFakulti;
        return $analitik->dashboard();
            break;             
        default:
        $analitik = new Analitik();
        return $analitik->dashboard();
            break;
    }
        
}

public function analitik(Request $request)
{
        $analitik = new Analitik();
        return $analitik->analitik($request);
    // if ($request->isMethod('post'))
            // {   
            //     $this->validate($request,[
            //         'year_report' => 'required|integer|min:2000',
            //         ]);
            //     $year_report= $request->input('year_report');
            // }

            // else{
            //     $year_report = $request->year_report;
            // }

            // $role = auth()->user()->role;
           
    
    // switch ($role) {
    //     case 'fakulti':
    //     $analitik = new AnalitikFakulti;
    //     // return $analitik->annual($request);
    //         break;             
    //     default:
    //     $analitik = new Analitik();
    //     return $analitik->analitik($request);
    // break;
    //}

        

   
}

}
