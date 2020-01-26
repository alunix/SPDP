<?php

namespace SPDP\Http\Controllers;

use Barryvdh\Debugbar\Twig\Extension\Debug;
use SPDP\Permohonan;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Fakulti;
use SPDP\PenilaianPanel;
use DB;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\LaporanClass;
use Debugbar;
use SPDP\Laporan;

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
                return $this->dashboard();
                break;
        }
    }

    public function dashboard()
    {
        $role = auth()->user()->role;
        $year = date('Y');
        $senarai = new SenaraiPermohonan();
        $baru_count = $senarai->queryPermohonanBaru()->count();
        $permohonan_baharu = $senarai->senaraiPermohonanBaru()->take(5);
        $progress = Permohonan::where('status_id', '!=', 1)->orWhere('status_id', '!=', 6)->orWhere('status_id', '!=', 7)->count();
        $lulus = Permohonan::where('status_id', '=', 6)->orWhere('status_id', '=', 7)->count();
        $senarai = new SenaraiPermohonan();
        $perakuan_count = $senarai->querySenaraiPerakuan()->count();
        $laporan = new LaporanClass();
        $laporans = $laporan->getLaporansDashboard();

        return response()->json([
            'role' => $role,
            'permohonan_baharu_count' => $baru_count,
            'permohonans' => $permohonan_baharu,
            'progress' => $progress,
            'lulus' => $lulus,
            'diperakui' => $perakuan_count,
            'laporans' => $laporans
        ]);
    }

    public function fakulti()
    {
        $role = auth()->user()->role;
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

        $progress = Permohonan::where('id_penghantar', auth()->user()->id)->where('status_id', '!=', 1)->orWhere('status_id', '!=', 6)->orWhere('status_id', '!=', 7)->count();
        $lulus = Permohonan::where('id_penghantar', auth()->user()->id)->where('status_id', '=', 6)->orWhere('status_id', '=', 7)->count();

        return response()->json([
            'role' => $role,
            'permohonans' => $permohonans->count(),
            'lulus' => $lulus,
            'progress' => $progress,
            'line_chart' => $line_chart,
            'pie_chart' => $pie_chart
        ]);
    }
}
