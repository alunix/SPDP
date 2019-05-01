<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Illuminate\Support\Facades\DB;

class PermohonanChartController extends Controller
{

public function dashboard(){

        // $sort_sums_years = Permohonan::select(
        // DB::raw('count(permohonan_id) as total_permohonans'),
        // DB::raw("DATE_FORMAT(created_at,'%Y') as years")
        // )->orderBy('created_at','asc')->groupBy('years')->get(); 

        // $chart = new PermohonanChart();       
        // $chart->labels($sort_sums_years->pluck('years')); 
        // $chart->dataset('Permohonan sepanjang beberapa tahun', 'bar',$sort_sums_years->pluck('total_permohonans'));
       
        // return view('pjk.analitik-permohonan-menu')->with('chart',$chart)->with('sort_sum_years',$sort_sums_years);

        $permohonans = Permohonan::with('user')->get()->sortBy('permohonan_id')->groupBy('user.fakulti_id');

        $permohonan = Permohonan::with(['user' => function($q){
            $q->select('fakulti_id', \DB::raw('count(permohonan_id) as total_permohonan'), 'user_id')
                  ->groupBy('fakulti_id');
        }]);

        $permohonans = Permohonan::with('user')->select(
            DB::raw('count(permohonan_id) as total_permohonan'), 
            DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )->orderBy('created_at','asc')->groupBy('id_penghantar')->get();
        

        return $permohonans;

}



public function index(Request $request)
{         
    
        $this->validate($request,[
           'year_report' => 'required|integer|min:2000',
            ]);
        
        $year_report= $request -> input('year_report');

      

        // $permohonans = Permohonan::with('user')->get()->groupBy('user.fakulti_id');
        $permohonans = Permohonan::with('user')->get()->sortBy('permohonan_id')->groupBy('user.fakulti_id');

        $permohonan = Permohonan::all()->groupBy('id_penghantar');

        $sort_sums_months = Permohonan::whereYear('created_at', '=', $year_report)->select(
            DB::raw('sum(ticket_price) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%M') as months"), DB::raw('sum(pax_num) as pax_num_total')
            )->orderBy('created_at','asc')->groupBy('months')->get();

        
       
        
        

        echo $permohonans;
        die(); 

       
       
       
        // $permohonan = Permohonan::where('status_permohonan_id',6)->orWhere('status_permohonan_id',7)->get();

        

        // if($permohonan->count()!=0){
        //     for($i=0;$i<$permohonan->count();++$i){
        //         $start_time = $permohonan[$i]->created_at;
        //         $end_time = $permohonan[$i]->updated_at;
        //         $permohonan_duration[$i] = $start_time->diffInHours($end_time);
        //     }
    
        //     // $fac = Permohonan::where('')
    
        //     $average_permohonan_duration =  array_sum($permohonan_duration)/$permohonan->count();
    
        //     return view ('pjk.analitik-permohonan')->with('total_permohonan',$total_permohonans_count)->with('average',$average_permohonan_duration)->with('permohonans_count',$permohonan->count());
        // }

        // else    
        //     abort(404);
       
       
        
    }
   
}
