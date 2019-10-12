<?php

namespace SPDP\Http\Controllers;

use SPDP\PenilaianPanel;
use Illuminate\Http\Request;

class PenilaianPanelController extends Controller
{
    public function index()
    {
        $penilaians = PenilaianPanel::all();
        return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
    }
}
