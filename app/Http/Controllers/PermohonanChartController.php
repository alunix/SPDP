<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Permohonan;

class PermohonanChartController extends Controller
{




public function index()
{
        $permohonans= Permohonan::all();
        $total_permohonans_count= $permohonans->count();
       
       
        $permohonan = Permohonan::where('status_permohonan_id',6)->orWhere('status_permohonan_id',7)->get();

        $fac = $permohonan->pluck('id_penghantar');

        
       
        for($i=0;$i<$permohonan->count();++$i){
            $start_time = $permohonan[$i]->created_at;
            $end_time = $permohonan[$i]->updated_at;
            $permohonan_duration[$i] = $start_time->diffInHours($end_time);
        }

        // $fac = Permohonan::where('')

        $average_permohonan_duration =  array_sum($permohonan_duration)/$permohonan->count();

        return view ('pjk.analitik-permohonan')->with('total_permohonan',$total_permohonans_count)->with('average',$average_permohonan_duration)->with('permohonans_count',$permohonan->count());
        
    }
   
}
