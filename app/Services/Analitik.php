<?php

namespace SPDP\Services;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Charts;
use Illuminate\Support\Facades\DB;
use SPDP\Services\AnalitikFakulti;


class Analitik
{
  
    public function dashboard()
    {
        $sort_sums_years = Permohonan::select(
            DB::raw('count(id) as total_permohonans'),
            DB::raw("DATE_FORMAT(created_at,'%Y') as years")
            )->groupBy('years')->get(); 
    
            $jenis_permohonan = Permohonan::select(
                DB::raw('count(jenis_id) as count_jenis_permohonan'),
                DB::raw("(jenis_id) as id")
                )->orderBy('count_jenis_permohonan','desc')->groupBy('jenis_id')->first(); 
            
     
            $A=  DB::table("permohonans") 
            ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_id')
            ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.huraian as huraian,count(id) as count") 
            ->groupBy('huraian') 
            ->get();
    
            $pie_chart = new PermohonanChart();
            $pie_chart->labels($A->pluck('huraian'));
            $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie',$A->pluck('count'))->backgroundColor(['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477'])->options([
                'backgroundColor'=> ['#C5CAE9', '#283593'],
            ]);
    
            $chart = new JenisPermohonanChart();       
            $chart->labels($sort_sums_years->pluck('years')); 
            $chart->dataset('Permohonan sepanjang beberapa tahun', 'bar',$sort_sums_years->pluck('total_permohonans'))->options([
                'backgroundColor'=> ['#C5CAE9', '#283593'],  'dimensions'=> [600,500],
            ]);
    
            $highest_jp_id =$jenis_permohonan->id;
            $highest_jp_id = Permohonan::find($highest_jp_id); // find jenis permohonan huraian through eloquent
            $highest_count_jp = $jenis_permohonan->count_jenis_permohonan;
            
    
            return view('pjk.analitik-permohonan-menu')->with('chart',$chart)->with('pie_chart',$pie_chart)->with('sort_sum_years',$sort_sums_years)->with('highest_jp_id',$highest_jp_id)->with('highest_count_jp',$highest_count_jp);
    }

public function annual($year_report){
    $lulus = Permohonan::where('status_permohonan_id',6)->orWhere('status_permohonan_id',7)->whereYear('created_at',$year_report)->get(); //find permohonan yang sudah dilulus
        
    if($lulus->count()!=0){
        for($i=0;$i<$lulus->count();++$i){
            $start_time = $lulus[$i]->created_at;
            $end_time = $lulus[$i]->updated_at;
            $permohonan_duration[$i] = $start_time->diffInHours($end_time);
        }

        $avg_duration =  array_sum($permohonan_duration)/$lulus->count();   
    }

    else
        $avg_duration=0;
    
        
     /*--------------------------------- Fakulti permohonan chart----------------------------------- */
    $permohonans = Fakulti::with(['permohonans' => function($query) use ($year_report) {
        $query->whereYear('permohonans.created_at', $year_report); //specify which table created at to query
      }])->get()->sortBy('fakulti_id');
    
    
    $count_permohonan= $permohonans->pluck('permohonans');

    for($i=0;$i<$count_permohonan->count();$i++){
        $A[$i]= count($count_permohonan[$i]);  //calculate count of permohoann in each fakulti
    } 
   
    $chart = new JenisPermohonanChart();       
    $chart->labels( $permohonans->pluck('kod')); 
    $chart->dataset('Permohonan sepanjang tahun '.$year_report, 'bar',$A);

     /*--------------------------------- Jenis permohonan pie chart----------------------------------- */
     $jenis=  DB::table("permohonans") 
    ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_id')
    ->whereYear('permohonans.created_at', $year_report)
    ->selectRaw("jenis_permohonans.huraian as huraian,count(id) as count") 
    ->groupBy('huraian') 
    ->get();

    $pie_chart = new PermohonanChart();
    $pie_chart->labels($jenis->pluck('huraian'));
    $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie',$jenis->pluck('count'))->backgroundColor(['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477'])->options([
        'backgroundColor'=> ['#C5CAE9', '#283593'],'dimensions'=>[1000,800]
    ]);

    /*------------------ Line chart for jumlah dokumen permohonan in a year--------------*/
    $Z=  DB::table("dokumen_permohonans") 
    ->whereYear('dokumen_permohonans.created_at',$year_report)
    ->selectRaw("DATE_FORMAT(dokumen_permohonans.created_at,'%M') as months, month(dokumen_permohonans.created_at) as month,count(dokumen_permohonan_id) as count")
    ->orderBy('month','asc') 
    ->groupBy('months') 
    ->get();

    $line_chart = new JenisPermohonanChart();
    $line_chart->labels($Z->pluck('months'));
    $line_chart->dataset('Dokumen permohonan', 'line',$Z->pluck('count'))->options([
        'backgroundColor'=> ['#C5CAE9', '#283593'],'dimensions'=>[1000,800]
    ]);


    /*--------------------------------- Table------------------------------------ */
    $permohonans = Fakulti::with(['permohonans' => function($query) use ($year_report) {
        $query->whereYear('permohonans.created_at', $year_report); //specify which table created at to query
      }])->get()->sortBy('fakulti_id');

    $count_permohonan= $permohonans->pluck('permohonans');

    for($i=0;$i<$count_permohonan->count();$i++){
        $Z[$i]= count($count_permohonan[$i]);  //calculate count of permohoann in each fakulti
    } 
    
    //Kemajuan permohonan perlu penambahbaikkan
    $kp_8 = Fakulti::with(['kemajuan_permohonans' => function($query)use($year_report){
        $query->whereYear('permohonans.created_at', $year_report)->where('kemajuan_permohonans.status_permohonan', 8)->orWhere('kemajuan_permohonans.status_permohonan', 9)->orWhere('kemajuan_permohonans.status_permohonan', 10)->orWhere('kemajuan_permohonans.status_permohonan',11); //specify which table created at to query
      }])->get()->sortBy('fakulti_id');

    $kp_list = $kp_8->pluck('kemajuan_permohonans');

    for($i=0;$i<$kp_list->count();$i++){
        $B[$i]= count($kp_list[$i]);  //calculate count of kemajuan permohoann in each fakulti
    } 

    //Kemajuan permohonan yang diluluskan
    $kp_6_7 = Fakulti::with(['permohonans' => function($query) use ($year_report) {
        $query->where('permohonans.status_permohonan_id', 6)->orWhere('permohonans.status_permohonan_id',7); //specify which table created at to query
      }])->get()->sortBy('fakulti_id');


    $kp_6_list =  $kp_6_7->pluck('permohonans');

    for($i=0;$i<$kp_6_list->count();$i++){
        $C[$i]= count($kp_6_list[$i]);  //calculate count of kemajuan permohoann in each fakulti
    } 

    $fakulti_nama = $permohonans->pluck('f_nama');
    $fakulti_id = $permohonans->pluck('fakulti_id');

     //Dokumen permohonans for each fakulti
     $dokumens = Fakulti::with('dokumen_permohonans')->get()->sortBy('fakulti_id')->pluck('dokumen_permohonans');
    
     for($i=0;$i<$dokumens->count();$i++){
         $doc[$i]= count($dokumens[$i]);  //calculate count of kemajuan permohoann in each fakulti
     } 
    
    for($i=0;$i<$permohonans->count();$i++){
        $D[$i]= array('fakulti_nama'=>$fakulti_nama[$i],
                            'jumlah_permohonan'=>$Z[$i],
                            'jumlah_diluluskan'=>$C[$i],
                            'jumlah_penambahbaikkan'=>$B[$i],
                            'jumlah_dokumen_permohonan'=>$doc[$i],
                            'fakulti_id'=>$fakulti_id[$i]);  //calculate count of permohoann in each fakulti
          }

    return view ('pjk.analitik')->with('chart',$chart)->with('year_report',$year_report)->with('avg_duration',$avg_duration)->with('pie_chart',$pie_chart)->with('permohonans',$D)->with('line_chart',$line_chart)->with('lulus',$lulus);
}

}

