<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use SPDP\Charts\PermohonanChart;
use SPDP\Charts\JenisPermohonanChart;
use SPDP\Permohonan;
use SPDP\Fakulti;
use Charts;
use SPDP\Services\AnalitikFakulti;
use SPDP\Services\Analitik;
use Illuminate\Support\Facades\Input;


class ChartController extends Controller
{
    public function dashboard()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'fakulti':
                $analitik = new AnalitikFakulti;
                return $analitik->dashboard();
                break;
            default:
                $analitik = new Analitik();
                return $analitik->dashboard();
                break;
        }
    }

    public function analitik(Request $request)
    {
        $analitik = new Analitik();
        return $analitik->analitik($request);
    }
}
