<?php

namespace SPDP\Services;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Charts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AnalitikFakulti
{

    public function dashboard()
    {
        $fakulti_id = auth()->user()->fakulti_id;
        //Jumlah permohonan
        $sort_sums_years =  DB::table("permohonans")
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->where('users.fakulti_id', $fakulti_id)
            ->selectRaw("count(permohonans.id) as total_permohonans,DATE_FORMAT(permohonans.created_at,'%Y') as years")
            ->groupBy('years')
            ->get();

        $jenis_permohonan =  DB::table("permohonans")
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->where('users.fakulti_id', $fakulti_id)
            ->selectRaw("count(jenis_permohonan_id) as count_jenis_permohonan,(jenis_permohonan_id) as id")
            ->orderBy('count_jenis_permohonan', 'desc')
            ->groupBy('jenis_permohonan_id')
            ->first();

        $A =  DB::table("permohonans")
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_permohonan_id')
            ->where('users.fakulti_id', $fakulti_id)
            ->selectRaw("year(permohonans.created_at) as years, jenis_permohonans.huraian as huraian,count(id) as count")
            ->groupBy('huraian')
            ->get();

        $pie_chart = new PermohonanChart();
        $pie_chart->labels($A->pluck('huraian'));
        $pie_chart->dataset('Permohonan sepanjang beberapa tahun', 'pie', $A->pluck('count'))->backgroundColor(['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6', '#DD4477'])->options([
            'backgroundColor' => ['#C5CAE9', '#283593'],
        ]);

        $chart = new JenisPermohonanChart();
        $chart->labels($sort_sums_years->pluck('years'));
        $chart->dataset('Permohonan sepanjang beberapa tahun', 'bar', $sort_sums_years->pluck('total_permohonans'))->options([
            'backgroundColor' => ['#C5CAE9', '#283593'],  'dimensions' => [600, 500],
        ]);

        $highest_jp_id = $jenis_permohonan->id;
        $highest_jp_id = Permohonan::find($highest_jp_id); // find jenis permohonan huraian through eloquent
        $highest_count_jp = $jenis_permohonan->count_jenis_permohonan;

        return view('pjk.analitik-permohonan-menu')->with('chart', $chart)->with('pie_chart', $pie_chart)->with('sort_sum_years', $sort_sums_years)->with('highest_jp_id', $highest_jp_id)->with('highest_count_jp', $highest_count_jp);
    }



    public function annual($request, $year_report)
    {
        if ($request->isMethod('post')) {
            $fakulti_id = auth()->user()->fakulti_id;
        } else {
            $fakulti_id = $request->fakulti_id;
        }

        $fakulti = Fakulti::find($fakulti_id);
        $permohonans = $fakulti->permohonans;
        $permohonans_id = $permohonans->sortBy('id')->pluck('id');
        $kp = $fakulti->kemajuan_permohonans->sortBy('permohonan_id');

        //----------------- Chart for Permohonan-------------------------
        $jenis =  DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_permohonan_id')
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->whereYear('permohonans.created_at', $year_report)
            ->where('users.fakulti_id', $fakulti_id)
            ->selectRaw("DATE_FORMAT(permohonans.created_at,'%Y') as years,jenis_permohonans.huraian as huraian,count(id) as count")
            ->groupBy('huraian')
            ->get();

        $pie_chart = new PermohonanChart();
        $pie_chart->labels($jenis->pluck('huraian'));
        $pie_chart->dataset('Permohonan fakulti ' . $fakulti->kod, 'pie', $jenis->pluck('count'))->backgroundColor(['#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#3B3EAC', '#0099C6', '#DD4477'])->options([
            'backgroundColor' => ['#C5CAE9', '#283593'],
        ]);

        //----------------- Chart for dokumen permohonan-------------------------
        $dokumen_permohonans = $fakulti->dokumen_permohonans;

        $Z =  DB::table("dokumen_permohonans")
            ->whereYear('created_at', $year_report)
            ->selectRaw("DATE_FORMAT(dokumen_permohonans.created_at,'%Y') as years,count(dokumen_permohonan_id) as count")
            ->orderBy('years', 'asc')
            ->groupBy('years')
            ->get();

        $line_chart = new JenisPermohonanChart();
        $line_chart->labels($Z->pluck('years'));
        $line_chart->dataset('Permohonan fakulti ' . $fakulti->kod, 'line', $Z->pluck('count'))->options([
            'backgroundColor' => ['#C5CAE9', '#283593'],
        ]);

        /*---------------- Jumlah penambahbaikkan ---------------------*/
        $improvements =  DB::table("kemajuan_permohonans")
            ->join('permohonans', 'permohonans.id', '=', 'kemajuan_permohonans.permohonan_id')
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->whereYear('kemajuan_permohonans.created_at', $year_report)
            ->where('users.fakulti_id', $fakulti_id)
            ->where('permohonans.id', 8)->orWhere('permohonans.id', 9)->orWhere('permohonans.id', 10)->orWhere('permohonans.id', 11)
            ->selectRaw("DATE_FORMAT(kemajuan_permohonans.created_at,'%Y') as years,count(kemajuan_permohonans.id) as count")
            ->get();

        $bar_chart = new JenisPermohonanChart();
        $bar_chart->labels($improvements->pluck('years'));
        $bar_chart->dataset('Permohonan fakulti ' . $fakulti->kod, 'line', $improvements->pluck('count'))->options([
            'backgroundColor' => ['#C5CAE9', '#283593'],
        ]);

        /*---------------- Permohonan lulus ---------------------*/
        $lulus =  DB::table("permohonans")
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->join('fakultis', 'fakultis.fakulti_id', '=', 'users.fakulti_id')
            ->whereYear('permohonans.created_at', $year_report)
            ->where('permohonans.status_permohonan_id', 6)->orWhere('permohonans.status_permohonan_id', 7)
            ->where('users.fakulti_id', $fakulti_id)
            ->get();

        $permohonans_id = Permohonan::whereIn('id', $lulus->pluck('id'))->get();
        $improvements_list =  Permohonan::whereIn('id', $improvements->pluck('id'))->get();

        return view('pjk.fakulti-analitik-2')->with('improvements_list', $improvements_list)->with('permohonan_lulus', $permohonans_id)->with('pie_chart', $pie_chart)->with('bar_chart', $bar_chart)->with('line_chart', $line_chart)->with('fakulti', $fakulti)->with('dokumen_permohonans', $dokumen_permohonans)->with('permohonans', $permohonans)->with('jumlah_penambahbaikkan', $improvements)->with('improvements', $improvements)->with('year_report', $year_report);
    }
}
