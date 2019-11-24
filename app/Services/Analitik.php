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
use Carbon\Carbon;
use Debugbar;
use SPDP\DokumenPermohonan;

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
        )->orderBy('count_jenis_permohonan', 'desc')->groupBy('jenis_id')->first();


        $A =  DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_id')
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

    public function analitik($request)
    {
        $start_date = $request->input('start_date', '2014-01-01');
        $end_date = $request->input('end_date', Carbon::today()->toDateString());
        // $start_date = $request->input('start_date', Carbon::today()->startOfMonth()->toDateString());
        // $end_date = $request->input('end_date', Carbon::today()->toDateString());
        $fakulti = $request->input('fakulti', "");

        # permohonan lulus
        $avg_lulus_duration = DB::table('permohonans')->where('status_id', 6)->orWhere('status_id', 7)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->selectRaw('avg(datediff(updated_at, created_at)) as avg_duration')->value('avg_duration');

        # jenis permohonan pie chart
        $jenis =  DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_id')
            ->whereBetween('permohonans.created_at', [$start_date, $end_date])
            ->selectRaw("jenis_permohonans.huraian as huraian,count(permohonans.id) as count")
            ->groupBy('huraian')
            ->get();

        $pie_chart = [];
        $pie_chart['labels'] = $jenis->pluck('huraian');
        $pie_chart['id'] = 'Jenis permohonan';
        $pie_chart['series'] = $jenis->pluck('count');

        # line chart for jumlah dokumens
        $dokumens =  DB::table("dokumens")
            ->whereBetween('created_at', [$start_date, $end_date])
            ->selectRaw("DATE_FORMAT(dokumens.created_at,'%M-%Y') as date,count(dokumen_permohonan_id) as count")
            ->orderBy('created_at', 'asc')
            ->groupBy('date')
            ->get();

        $line_chart = [];
        $line_chart['labels'] = $dokumens->pluck('date');
        $line_chart['series'] = $dokumens->pluck('count');
        $line_chart['id'] = 'Dokumen dihantar';

        # table
        $datas = Fakulti::withCount([
            'permohonans as permohonans_count' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('permohonans.created_at', [$start_date, $end_date]);
            }, 'permohonans as lulus_count' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('permohonans.created_at', [$start_date, $end_date])
                    ->where('permohonans.status_id', 6)->orWhere('permohonans.status_id', 7);
            }, 'kemajuan_permohonans as penambahbaikkan_count' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('permohonans.created_at', [$start_date, $end_date])
                    ->where('kemajuan_permohonans.status_id', 8)
                    ->orWhere('kemajuan_permohonans.status_id', 9)
                    ->orWhere('kemajuan_permohonans.status_id', 10)
                    ->orWhere('kemajuan_permohonans.status_id', 11);
            }, 'dokumens as dokumens_count' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('dokumens.created_at', [$start_date, $end_date]);
            }
        ])->get();

        # bar chart permohonan
        $bar_chart = [];
        $bar_chart['labels'] = $datas->pluck('kod');
        $bar_chart['series'] = $datas->pluck('permohonans_count');
        $bar_chart['id'] = 'Jumlah permohonan dari ' . $start_date . ' sehingga ' . $end_date;

        return response()->json([
            'bar_chart' => $bar_chart, 'avg_lulus_duration' => $avg_lulus_duration,
            'pie_chart' => $pie_chart, 'line_chart' => $line_chart, 'datas' => $datas
        ]);
    }
}
