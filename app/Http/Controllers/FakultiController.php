<?php

namespace SPDP\Http\Controllers;

use SPDP\Fakulti;
use Illuminate\Http\Request;
use SPDP\Services\AnalitikFakulti;

class FakultiController extends Controller
{
    public function permohonanBaru()
    {
        return view('fakulti.permohonan-baharu');
    }

    public function getFakultis()
    {
        $fakultis = Fakulti::select('f_nama', 'fakulti_id')->get();
        return response()->json($fakultis);
    }

    public function analitik(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'year_report' => 'required|integer|min:2000',
            ]);
            $year_report = $request->input('year_report');
        } else {
            $year_report = $request->year_report;
        }
        $analitik = new AnalitikFakulti();
        return $analitik->annual($request, $year_report);
    }
}
