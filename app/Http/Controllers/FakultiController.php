<?php

namespace SPDP\Http\Controllers;

use SPDP\Fakulti;
use Illuminate\Http\Request;
use SPDP\Services\AnalitikFakulti;

class FakultiController extends Controller
{
    public function getFakultis()
    {
        $fakultis = Fakulti::select('f_nama', 'fakulti_id')->get();
        return response()->json($fakultis);
    }
}
