<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Fakulti;
use SPDP\PenilaianPanel;
use DB;
use SPDP\Services\SenaraiPermohonan;
use Debugbar;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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

    public function dashboard($role)
    {
        $year = date('Y');
        $senarai = new SenaraiPermohonan();
        $permohonan_baharu = $senarai->queryPermohonanBaru()->count();
        $permohonans = Fakulti::with(['permohonans' => function ($query) use ($year) {
            $query->select(['permohonans.id', 'permohonans.created_at']);
            $query->whereYear('permohonans.created_at', $year); //specify which table created at to query
        }])->get()->sortBy('fakulti_id');

        $count_permohonan = $permohonans->pluck('permohonans');

        for ($i = 0; $i < sizeof($count_permohonan); $i++) {
            $A[$i] = count($count_permohonan[$i]);  //calculate count of permohonan in each fakulti
        }

        $chart = new JenisPermohonanChart();
        $chart->labels($permohonans->pluck('kod'));
        $chart->dataset('Permohonan sepanjang tahun ' . $year, 'bar', $A);

        /*------------------ Line chart for jumlah dokumen permohonan in a year--------------*/
        $Z =  DB::table("dokumens")
            //->join('jenis_permohonans','jenis_permohonans.id','=','permohonans.jenis_id')
            ->selectRaw("DATE_FORMAT(dokumens.created_at,'%M') as months, count(dokumen_permohonan_id) as count")
            ->groupBy('months')
            ->get();

        $line_chart = new JenisPermohonanChart();
        $line_chart->labels($Z->pluck('months'));
        $line_chart->dataset('Dokumen permohonan', 'line', $Z->pluck('count'))->options([
            'backgroundColor' => ['#C5CAE9', '#283593'], 'dimensions' => [500, 500]
        ]);

        $A = DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_id')
            ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.huraian as huraian,count(permohonans.id) as count")
            ->groupBy('huraian')
            ->get();

        $pie_chart = new JenisPermohonanChart();
        $pie_chart->labels($A->pluck('huraian'));
        $pie_chart->dataset('Jenis permohonan tahun ' . $year, 'pie', $A->pluck('count'))->color(['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6', '#DD4477'])->options([
            'colorCount' => 10, 'dimensions' => [800, 800]
        ]);

        $progress = Permohonan::where('status_id', '!=', 1)->orWhere('status_id', '!=', 6)->orWhere('status_id', '!=', 7)->count();
        $lulus = Permohonan::where('status_id', '=', 6)->orWhere('status_id', '=', 7)->count();
        $diperakui = $this->permohonanDiperakukan();

        return response()->json(['progress' => $progress, 'lulus' => $lulus, 'diperakui' => $diperakui, 'line_chart' => $line_chart, 'pie_chart' => $pie_chart]);

        // return view ('panel_penilai.senarai-testing')->with('permohonans',$permohonan_baharu)->with('chart',$chart)->with('line_chart',$line_chart)->with('pie_chart',$pie_chart)->with('permohonan_in_progress', $permohonan_in_progress)->with('permohonan_diluluskan',$permohonan_diluluskan)->with('permohonan_diperakui',$permohonan_diperakui);
    }

    public function fakulti()
    {
        $fakulti_id = auth()->user()->fakulti_id;
        $year = date('Y');

        /*------------------ Line chart for jumlah dokumen permohonan in a year--------------*/
        $dokumens =  DB::table("dokumens")
            ->join('permohonans', 'dokumens.permohonan_id', '=', 'permohonans.id')
            ->join('users', 'permohonans.id_penghantar', '=', 'users.id')
            ->join('fakultis', 'users.fakulti_id', '=', 'fakultis.fakulti_id')
            ->whereYear('dokumens.created_at', $year)
            ->where('fakultis.fakulti_id', '=', $fakulti_id)
            ->selectRaw("DATE_FORMAT(dokumens.created_at,'%M') as months,month(dokumens.created_at) as month,count(dokumens.dokumen_permohonan_id) as count")
            ->orderBy('month', 'asc')
            ->groupBy('months')
            ->get();

        $line_chart = [];
        $line_chart['labels'] = $dokumens->pluck('months');
        $line_chart['data'] =  $dokumens->pluck('count');
        $line_chart['id'] =  'Dokumen permohonan';

        /*----------Permohonans-----------*/
        $permohonans =  DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_id')
            ->join('users', 'permohonans.id_penghantar', '=', 'users.id')
            ->join('fakultis', 'users.fakulti_id', '=', 'fakultis.fakulti_id')
            ->whereYear('permohonans.created_at', $year)
            ->where('fakultis.fakulti_id', '=', $fakulti_id)
            ->selectRaw("month(permohonans.created_at) as month, jenis_permohonans.huraian as huraian,count(permohonans.id) as count")
            ->groupBy('huraian')
            ->get();

        $pie_chart = [];
        $pie_chart['labels'] = $permohonans->pluck('huraian');
        $pie_chart['data'] = $permohonans->pluck('count');
        $pie_chart['id'] = 'Jenis permohonan tahun';

        $progress = Permohonan::where('status_id', '!=', 1)->orWhere('status_id', '!=', 6)->orWhere('status_id', '!=', 7)->select('id')->count();
        $lulus = Permohonan::where('status_id', '=', 6)->orWhere('status_id', '=', 7)->select('id')->count();

        return response()->json([
            'permohonans' => $permohonans->count(),
            'lulus' => $lulus, 'progress' => $progress, 'line_chart' => $line_chart,
            'pie_chart' => $pie_chart
        ]);
    }

    public function permohonanDiperakukan()
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
                $permohonans = Permohonan::where('jenis_id', '!=', '8')->where('status_id', '=', 3)->get();
                return $permohonans;
                break;
            default:
                $permohonans = new Permohonan();
                return $permohonans;
                break;
        }
    }

    public function permohonanCount()
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
                return Permohonan::where('jenis_id', '!=', '8')->where('status_id', '=', '1')->count();
                break;
            case 'jppa':
                return Permohonan::where('jenis_id', 8)->where('status_id', 1)->orWhere('status_id', 4)->count();
                break;
            case 'penilai':
                $user_id = auth()->user()->id;
                $penilaian = PenilaianPanel::where('id_penilai', $user_id)->pluck('permohonan_id');
                return Permohonan::whereIn('id', $penilaian)->where('status_id', 2)->count();
                break;
            case 'senat':
                return Permohonan::where('status_id', '=', '5')->count();
                break;
            default:
                return;
                break;
        }
    }
}
