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
    public function analitik($request)
    {
        $start_date = $request->input('start_date') ?: Carbon::today()->startOfMonth()->toDateString();
        $end_date = $request->input('end_date') ?: Carbon::today()->toDateString();
        $fakulti = $request->input('fakulti');

        # permohonan lulus
        $avg_lulus_duration = $this->average_lulus_duration($start_date, $end_date);

        # jenis permohonan pie chart query
        $jenis_query = $this->jenis_query($start_date, $end_date);

        # line chart for jumlah dokumens query
        $dokumens_query = $this->dokumens_query($start_date, $end_date);

        # table query
        $table_query = $this->table_query($start_date, $end_date);

        # preparing query
        $dokumens = [];
        $datas = [];
        $jenis = [];
        if (!$fakulti) {
            $datas = $table_query->get();
            $dokumens = $dokumens_query->get();
            $jenis = $jenis_query->get();
        } else {
            $datas = $table_query->where('fakulti_id', $fakulti)->get();
            $dokumens = $dokumens_query->where('users.fakulti_id', $fakulti)->get();
            $jenis = $jenis_query->where('users.fakulti_id', $fakulti)->get();
        }

        #line chart dokumen dihantar
        $line_chart = [];
        $line_chart['labels'] = $dokumens->pluck('date');
        $line_chart['series'] = $dokumens->pluck('count');
        $line_chart['id'] = 'Dokumen dihantar';

        # pie chart jenis permohonan
        $pie_chart = [];
        $pie_chart['labels'] = $jenis->pluck('huraian');
        $pie_chart['id'] = 'Jenis permohonan';
        $pie_chart['series'] = $jenis->pluck('count');

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

    private function  average_lulus_duration($start_date, $end_date)
    {
        $query = DB::table('permohonans')
            ->where('status_id', 6)->orWhere('status_id', 7)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->selectRaw('avg(datediff(updated_at, created_at)) as avg_duration')->value('avg_duration');

        return $query;
    }

    private function jenis_query($start_date, $end_date)
    {
        $query = DB::table("permohonans")
            ->join('jenis_permohonans', 'jenis_permohonans.id', '=', 'permohonans.jenis_id')
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->whereBetween('permohonans.created_at', [$start_date, $end_date])
            ->selectRaw("jenis_permohonans.huraian as huraian,count(permohonans.id) as count")
            ->groupBy('huraian');

        return $query;
    }

    private function dokumens_query($start_date, $end_date)
    {
        $query = DB::table("dokumens")
            ->join('permohonans', 'permohonans.id', '=', 'dokumens.permohonan_id')
            ->join('users', 'users.id', '=', 'permohonans.id_penghantar')
            ->whereBetween('dokumens.created_at', [$start_date, $end_date])
            ->selectRaw("DATE_FORMAT(dokumens.created_at,'%M-%Y') as date,count(dokumen_permohonan_id) as count")
            ->orderBy('dokumens.created_at', 'asc')
            ->groupBy('date');

        return $query;
    }

    private function table_query($start_date, $end_date)
    {
        $query =  Fakulti::withCount([
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
        ]);

        return $query;
    }
}
