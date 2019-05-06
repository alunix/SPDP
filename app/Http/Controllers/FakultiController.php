<?php

namespace SPDP\Http\Controllers;
use SPDP\Fakulti;
use SPDP\KemajuanPermohonan;
use SPDP\User;
use SPDP\Penilain;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;

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
        //$kemajuan_permohonan= Fakulti::find($fakulti_id)->where('status_permohonan', 8)->orWhere('status_permohonan', 9)->orWhere('status_permohonan', 10)->orWhere('status_permohonan',11)->groupBy('permohonan_id');
        
        // $kemajuan_permohonan = Fakulti::find($fakulti_id)->with(['kemajuan_permohonans' => function($query){
        //     $query->where('kemajuan_permohonans.status_permohonan', 8)->orWhere('kemajuan_permohonans.status_permohonan', 9)->orWhere('kemajuan_permohonans.status_permohonan', 10)->orWhere('kemajuan_permohonans.status_permohonan',11); //specify which table created at to query
        //   }])->get()->sortBy('permohonan_id');

        $kp = $fakulti->kemajuan_permohonans->sortBy('permohonan_id','DESC');

        return $permohonans->orderBy('permohonan_id','DESC');

        $jenis=  DB::table("permohonans") 
        ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->where('users.fakulti_id', $fakulti_id)
        ->selectRaw("jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
        ->groupBy('jenis_permohonan_huraian') 
        ->get();

        $pie_chart = new PermohonanChart();
        $pie_chart->labels($jenis->pluck('huraian'));
        $pie_chart->dataset('Permohonan fakulti'.$fakulti->fnama_kod, 'pie',$jenis->pluck('count'))->options([
            'backgroundColor'=> ['#C5CAE9', '#283593'],
        ]);
        
        //----------------- Chart for dokumen permohonan-------------------------
        // $dokumen_permohonans = $fakulti->dokumen_permohonans;

        // $pie_chart = new PermohonanChart();
        // $pie_chart->labels($jenis->pluck('huraian'));
        // $pie_chart->dataset('Permohonan fakulti'.$fakulti->fnama_kod, 'line',$jenis->pluck('count'))->options([
        //     'backgroundColor'=> ['#C5CAE9', '#283593'],
        // ]);

      

        return view ('pjk.fakulti-analitik')->with('pie_chart',$pie_chart)->with('fakulti',$fakulti)->with('dokumen_permohonans',$dokumen_permohonans)->with('permohonans',$permohonans);
        
        
    }
}
