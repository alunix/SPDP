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
                    return view('dashboard/fakulti-dashboard');
                break;
            // case 'pjk':
            //         return view('dashboard/pjk-dashboard');
            //     break; 
            // case 'senat':
            //     return view('dashboard/senat-dashboard');
            // break; 
            // case 'penilai':
            //         return view('dashboard/penilai-dashboard');
            //     break; 
            // case 'jppa':
            //         return view('dashboard/jppa-dashboard');
            //     break; 
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
         'backgroundColor'=> ['#C5CAE9', '#283593'],'dimensions'=>[1000,800]
     ]);
 
     $A=  DB::table("permohonans") 
         ->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_permohonan_id')
         ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.jenis_permohonan_huraian as huraian,count(permohonan_id) as count") 
         ->groupBy('jenis_permohonan_huraian') 
         ->get();
 
     $pie_chart = new PermohonanChart();
     $pie_chart->labels($A->pluck('huraian'));
     $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie',$A->pluck('count'))->options([
         'backgroundColor'=> ['blue','orange','green','pink','gray'],
     ]);
     
     $permohonan_in_progress = Permohonan::where('status_permohonan_id','!=',1)->orWhere('status_permohonan_id','!=',6)->orWhere('status_permohonan_id','!=',7)->get()->count();
     $permohonan_diluluskan = Permohonan::where('status_permohonan_id','=',6)->orWhere('status_permohonan_id','=',7)->get()->count();
 
    
 
 
         return view ('panel_penilai.senarai-testing')->with('permohonans',$permohonan_baharu)->with('chart',$chart)->with('line_chart',$line_chart)->with('pie_chart',$pie_chart)->with('permohonan_in_progress', $permohonan_in_progress)->with('permohonan_diluluskan',$permohonan_diluluskan);
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
    

    public function fakulti(Request $req){
        return view('dashboard/fakulti-dashboard');
        
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