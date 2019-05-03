<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Charts;
use Illuminate\Support\Facades\DB;

class PermohonanChartController extends Controller
{

public function dashboard(){

        $sort_sums_years = Permohonan::select(
        DB::raw('count(permohonan_id) as total_permohonans'),
        DB::raw("DATE_FORMAT(created_at,'%Y') as years")
        )->groupBy('years')->get(); 

        $jenis_permohonan = Permohonan::select(
            DB::raw('count(jenis_permohonan_id) as count_jenis_permohonan'),
            DB::raw("(jenis_permohonan_id) as id")
            )->orderBy('count_jenis_permohonan','desc')->groupBy('jenis_permohonan_id')->first(); 
        
 
        $A=  DB::table("permohonans") 
        ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
        ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
        ->groupBy('jenis_permohonan_huraian') 
        ->get();

        $pie_chart = new PermohonanChart();
        $pie_chart->labels($A->pluck('huraian'));
        $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie',$A->pluck('count'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],
        ]);;

        $chart = new PermohonanChart();       
        $chart->labels($sort_sums_years->pluck('years')); 
        $chart->dataset('Permohonan sepanjang beberapa tahun', 'bar',$sort_sums_years->pluck('total_permohonans'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],  'dimensions'=> [600,500],
        ]);

        $highest_jp_id =$jenis_permohonan->id;
        $highest_jp_id = Permohonan::find($highest_jp_id); // find jenis permohonan huraian through eloquent
        $highest_count_jp = $jenis_permohonan->count_jenis_permohonan;

        return view('pjk.analitik-permohonan-menu')->with('chart',$chart)->with('pie_chart',$pie_chart)->with('sort_sum_years',$sort_sums_years)->with('highest_jp_id',$highest_jp_id)->with('highest_count_jp',$highest_count_jp);
        
}



public function index(Request $request)
{         
    
        $this->validate($request,[
           'year_report' => 'required|integer|min:2000',
            ]);
        
        $year_report= $request -> input('year_report');
       
        $lulus = Permohonan::where('status_permohonan_id',6)->orWhere('status_permohonan_id',7)->whereYear('created_at',$year_report)->get(); //find permohonan yang sudah dilulus

        for($i=0;$i<$lulus->count();++$i){
                    $start_time = $lulus[$i]->created_at;
                    $end_time = $lulus[$i]->updated_at;
                    $permohonan_duration[$i] = $start_time->diffInHours($end_time);
                }
        
        $avg_duration =  array_sum($permohonan_duration)/$lulus->count();

        $permohonans = Fakulti::with(['permohonans' => function($query) use ($year_report) {
            $query->whereYear('permohonans.created_at', $year_report); //specify which table created at to query
          }])->get()->sortBy('fakulti_id');
        
        
        $count_permohonan= $permohonans->pluck('permohonans');

        for($i=0;$i<$count_permohonan->count();$i++){
            $A[$i]= count($count_permohonan[$i]);  //calculate count of permohoann in each fakulti
        } 
       
        $chart = new JenisPermohonanChart();       
        $chart->labels( $permohonans->pluck('fnama_kod')); 
        $chart->dataset('Permohonan sepanjang tahun '.$year_report, 'bar',$A);

        $jenis=  DB::table("permohonans") 
        ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
        ->whereYear('permohonans.created_at', $year_report)
        ->selectRaw("jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
        ->groupBy('jenis_permohonan_huraian') 
        ->get();

        $pie_chart = new PermohonanChart();
        $pie_chart->labels($jenis->pluck('huraian'));
        $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie',$jenis->pluck('count'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],'dimensions'=>[1000,800]
        ]);;



       
        return view ('pjk.analitik-permohonan')->with('chart',$chart)->with('year_report',$year_report)->with('avg_duration',$avg_duration)->with('pie_chart',$pie_chart);
            
        //----------------------------------------------------------------------------------------------------------------------------------------------------
        

        // if($permohonan->count()!=0){
        //     for($i=0;$i<$permohonan->count();++$i){
        //         $start_time = $permohonan[$i]->created_at;
        //         $end_time = $permohonan[$i]->updated_at;
        //         $permohonan_duration[$i] = $start_time->diffInHours($end_time);
        //     }
    
        //     $average_permohonan_duration =  array_sum($permohonan_duration)/$permohonan->count();
    
        //     return view ('pjk.analitik-permohonan')->with('total_permohonan',$total_permohonans_count)->with('average',$average_permohonan_duration)->with('permohonans_count',$permohonan->count());
        // }

        // else    
        //     abort(404);
       
       
        
    }

    public function testing(){
        $year_report=2018;

        $permohonans = Fakulti::with(['permohonans' => function($query) use ($year_report) {
            $query->whereYear('permohonans.created_at', $year_report); //specify which table created at to query
          }])->get()->sortBy('fakulti_id');

        $count_permohonan= $permohonans->pluck('permohonans');

        for($i=0;$i<$count_permohonan->count();$i++){
            $A[$i]= count($count_permohonan[$i]);  //calculate count of permohoann in each fakulti
        } 

        return $A;

    }
   
}
