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
   
    public function analitik($id)
    {   
        $fakulti = Fakulti::find($id);
        $fakulti_id = $fakulti->fakulti_id;
        $permohonans = $fakulti->permohonans;
        $permohonans_id = $permohonans->sortBy('permohonan_id')->pluck('permohonan_id');
        $kp = $fakulti->kemajuan_permohonans->sortBy('permohonan_id');

        //----------------- Chart for Permohonan-------------------------
        $jenis=  DB::table("permohonans") 
        ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->where('users.fakulti_id', $fakulti_id)
        ->selectRaw("DATE_FORMAT(permohonans.created_at,'%Y') as years,jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
        ->groupBy('jenis_permohonan_huraian') 
        ->get();
      
        $pie_chart = new PermohonanChart();
        $pie_chart->labels($jenis->pluck('huraian'));
        $pie_chart->dataset('Permohonan fakulti '.$fakulti->fnama_kod, 'pie',$jenis->pluck('count'))->backgroundColor(['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477'])->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],
        ]);
        
        //----------------- Chart for dokumen permohonan-------------------------
        $dokumen_permohonans = $fakulti->dokumen_permohonans;

        $Z=  DB::table("dokumen_permohonans") 
        ->selectRaw("DATE_FORMAT(dokumen_permohonans.created_at,'%Y') as years,count(dokumen_permohonan_id) as count")
        ->orderBy('years','asc') 
        ->groupBy('years') 
        ->get();
        
        $line_chart = new JenisPermohonanChart();
        $line_chart->labels($Z->pluck('years'));
        $line_chart->dataset('Permohonan fakulti '.$fakulti->fnama_kod, 'line',$Z->pluck('count'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],
        ]);

        /*---------------- Jumlah penambahbaikkan ---------------------*/
        $improvements=  DB::table("kemajuan_permohonans") 
        ->join('permohonans','permohonans.permohonan_id','=','kemajuan_permohonans.permohonan_id')
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->where('users.fakulti_id', $fakulti_id)
        ->where('permohonans.permohonan_id', 8)->orWhere('permohonans.permohonan_id', 9)->orWhere('permohonans.permohonan_id', 10)->orWhere('permohonans.permohonan_id',11)
        ->selectRaw("DATE_FORMAT(kemajuan_permohonans.created_at,'%Y') as years,count(kemajuan_permohonans.id) as count") 
        ->get();

        $bar_chart = new JenisPermohonanChart();
        $bar_chart->labels($improvements->pluck('years'));
        $bar_chart->dataset('Permohonan fakulti '.$fakulti->fnama_kod, 'line',$improvements->pluck('count'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],
        ]);

         /*---------------- Permohonan lulus ---------------------*/
         $lulus=  DB::table("permohonans") 
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->where('users.fakulti_id', $fakulti_id)
        ->where('permohonans.status_permohonan_id', 6)->orWhere('permohonans.status_permohonan_id', 7)
        ->get();

        $permohonans_id = Permohonan::whereIn('permohonan_id',$lulus->pluck('permohonan_id'))->get();
        $improvements_list =  Permohonan::whereIn('permohonan_id',$improvements->pluck('permohonan_id'))->get();

       return view ('pjk.fakulti-analitik-2')->with('improvements_list',$improvements_list)->with('permohonan_lulus',$permohonans_id)->with('pie_chart',$pie_chart)->with('bar_chart',$bar_chart)->with('line_chart',$line_chart)->with('fakulti',$fakulti)->with('dokumen_permohonans',$dokumen_permohonans)->with('permohonans',$permohonans)->with('jumlah_penambahbaikkan',$improvements)->with('improvements',$improvements);
        
        
    }
}
