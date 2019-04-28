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
        $total_time=0;


        // for($i=0;$i<$permohonans_count;++$i){

        //     if($permohonans[$i]->status_permohonan_id==6||$permohonans[$i]->status_permohonan_id==7){
        //         $total_time= $total_time +(($permohonans[$i]->updated_at)-($permohonans[$i]->created_at));
        //         $permohonan = $permohonan+1;
        //     }
        // }

        // $average_time = $total_time/$permohonan;

        $permohonan = Permohonan::where('status_permohonan_id',6)->orWhere('status_permohonan_id',7)->get();

       
        for($i=0;$i<$permohonan->count();++$i){

            $start_time = $permohonan[$i]->created_at;
            $end_time = $permohonan[$i]->updated_at;
            $permohonan_duration[$i] = $start_time->diffInHours($end_time);
            

        }

        $average_permohonan_duration =  array_sum($permohonan_duration)/$permohonan->count();

        return view ('pjk.analitik-permohonan')->with('total_permohonan',$total_permohonans_count)->with('average',$average_permohonan_duration)->with('permohonans_count',$permohonan->count());

        


        
        


    }
   
}
