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
        $permohonans_count= $permohonans->count();
        $total_time=0;


        for($i=0;$i<$permohonans_count;++$i){

            if($permohonans[$i]->status_permohonan_id==6||$permohonans[$i]->status_permohonan_id==6){
                $total_time= $total_time +(($permohonans[$i]->updated_at)-($permohonans[$i]->created_at));
            }

            // $total_time = Ticket::where('status_permohonan_id', 6)->orWhere('status_permohonan_id', 7)->select(
            //     DB::raw('(updated_at)-(created_at) as total_time'),DB::raw('sum(pax_num) as pax_num_total'),
            //     DB::raw("DATE_FORMAT(created_at,'%Y') as years")
            //     )->orderBy('created_at','asc')->groupBy('years')->get();  

            $total_time = Permohonan::where('status_permohonan_id', 6)->orWhere('status_permohonan_id', 7)->select(
                DB::raw('(updated_at)-(created_at) as total_time'),DB::raw('sum(pax_num) as pax_num_total'),
                DB::raw("DATE_FORMAT(created_at,'%Y') as years")
                )->orderBy('created_at','asc')->groupBy('years')->get();  
        }
        
        return view ('fakulti.fakulti-insert-permohonan')->with('permohonans',$permohonans);
    }
   
}
