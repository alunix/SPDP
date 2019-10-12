<?php
namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use Illuminate\Http\Request;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\ShowPermohonan;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use Charts;
use Illuminate\Support\Carbon;
use SPDP\Fakulti;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
 
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    // This is for after authenticated, which homepage the system will redirect.
    public function index(){
        $role = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                    return $this->fakulti();
                break;
            default:
            return $this->dashboard($role);
                break;
        }
    
    }

    public function dashboard($role){
        $year_report = date('Y');
        $sp = new SenaraiPermohonan();
        $permohonan_baharu = $this->senaraiPermohonan($sp)->count();
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
 
     /*------------------ Line chart for jumlah dokumen permohonan in a year--------------*/
     $Z=  DB::table("dokumen_permohonans") 
     //->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
     ->selectRaw("DATE_FORMAT(dokumen_permohonans.created_at,'%M') as months, count(dokumen_permohonan_id) as count") 
     ->groupBy('months') 
     ->get();
 
     $line_chart = new JenisPermohonanChart();
     $line_chart->labels($Z->pluck('months'));
     $line_chart->dataset('Dokumen permohonan', 'line',$Z->pluck('count'))->options([
         'backgroundColor'=> ['#C5CAE9', '#283593']
         ,'dimensions'=>[500,500]
     ]);
 
     $A=  DB::table("permohonans") 
         ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
         ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
         ->groupBy('jenis_permohonan_huraian') 
         ->get();
 
     $pie_chart = new JenisPermohonanChart();
     $pie_chart->labels($A->pluck('huraian'));
     $pie_chart->dataset('Jenis permohonan tahun '.$year_report, 'pie',$A->pluck('count'))->color(['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477'])->options([
        'colorCount'=>10,'dimensions'=>[800,800]
     ]);
     
     $permohonan_in_progress = Permohonan::where('status_permohonan_id','!=',1)->orWhere('status_permohonan_id','!=',6)->orWhere('status_permohonan_id','!=',7)->get()->count();
     $permohonan_diluluskan = Permohonan::where('status_permohonan_id','=',6)->orWhere('status_permohonan_id','=',7)->get()->count();
     $permohonan_diperakui = $this->permohonanDiperakukan();

     return view ('panel_penilai.senarai-testing')->with('permohonans',$permohonan_baharu)->with('chart',$chart)->with('line_chart',$line_chart)->with('pie_chart',$pie_chart)->with('permohonan_in_progress', $permohonan_in_progress)->with('permohonan_diluluskan',$permohonan_diluluskan)->with('permohonan_diperakui',$permohonan_diperakui);
    }

    public function fakulti(){
    
    $fakulti_id=auth()->user()->fakulti_id;
    $year_report = date('Y');
    /*------------------ Line chart for jumlah dokumen permohonan in a year--------------*/
    $dokumen_permohonans=  DB::table("dokumen_permohonans") 
    ->join('permohonans','dokumen_permohonans.permohonan_id','=','permohonans.permohonan_id')
    ->join('users','permohonans.id_penghantar','=','users.id')
    ->join('fakultis','users.fakulti_id','=','fakultis.fakulti_id')
    ->whereYear('dokumen_permohonans.created_at',$year_report)
    ->where('fakultis.fakulti_id','=',$fakulti_id)
    ->selectRaw("DATE_FORMAT(dokumen_permohonans.created_at,'%M') as months,month(dokumen_permohonans.created_at) as month,count(dokumen_permohonans.dokumen_permohonan_id) as count") 
    // ->orderBy('dokumen_permohonans.created_at','asc') 
    ->orderBy('month','asc') 
    ->groupBy('months')
    ->get();
  
     $line_chart = new JenisPermohonanChart();
     $line_chart->labels($dokumen_permohonans->pluck('months'));
     $line_chart->dataset('Dokumen permohonan', 'line',$dokumen_permohonans->pluck('count'))->options([
         'backgroundColor'=> ['#C5CAE9', '#283593']
         ,'dimensions'=>[500,500]
     ]);
    /*----------Permohonans-----------*/
    $permohonans=  DB::table("permohonans") 
        ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
        ->join('users','permohonans.id_penghantar','=','users.id')
        ->join('fakultis','users.fakulti_id','=','fakultis.fakulti_id')
        ->whereYear('permohonans.created_at',$year_report)
        ->where('fakultis.fakulti_id','=',$fakulti_id)
        ->selectRaw("month(permohonans.created_at) as month, jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
        ->groupBy('jenis_permohonan_huraian') 
        ->get();

     $pie_chart = new JenisPermohonanChart();
     $pie_chart->labels($permohonans->pluck('huraian'));
     $pie_chart->dataset('Jenis permohonan tahun '.$year_report, 'pie',$permohonans->pluck('count'))->color(['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477'])->options([
        'colorCount'=>10,'dimensions'=>[800,800]
     ]);
     
    
     $progress = Permohonan::where('status_permohonan_id','!=',1)->orWhere('status_permohonan_id','!=',6)->orWhere('status_permohonan_id','!=',7)->get()->count();
     $lulus = Permohonan::where('status_permohonan_id','=',6)->orWhere('status_permohonan_id','=',7)->get()->count();
     
    //  return view ('dashboard.fakulti-dashboard')->with('dokumen_permohonans',$dokumen_permohonans)->with('permohonans',$permohonans)->with('line_chart',$line_chart)->with('pie_chart',$pie_chart)->with('permohonan_in_progress', $progress)->with('permohonan_diluluskan',$lulus);
     return response()->json(['dokumens'=>$dokumen_permohonans, 'permohonans'=>$permohonans, 'lulus'=>$lulus, 'progress' => $progress ]);
    }

    public function senaraiPermohonan($sp){
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
                    return $sp->pjk();
                break; 
            case 'senat':
            return $sp->senat();
            break; 
            case 'penilai':
            return $sp->penilai();
                break; 
            case 'jppa':
            return $sp->jppa();
                break; 
            default:
                   return;
                break;
        }
        
        }
    
    public function permohonanDiperakukan(){
        
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
            $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=',3)->get();
            return $permohonans;
                break;             
            default:
            $permohonans = new Permohonan();
            return $permohonans;
                   return;
                break;
        }
    }

    public function pjk(Request $req){
        return view('dashboard/pjk-dashboard');
            
    }
    public function penilai(Request $req){
        return view('dashboard/penilai-dashboard');
                
        }
    public function jppa(Request $req){
        return view('dashboard/jppa-dashboard');
                
        }
    public function senat(Request $req){
        return view('dashboard/senat-dashboard');
                
        }
    
   
}