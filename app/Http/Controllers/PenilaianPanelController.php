<?php

namespace SPDP\Http\Controllers;

use SPDP\PenilaianPanel;

class PenilaianPanelController extends Controller
{
    public function index()
    {
        $penilaians = PenilaianPanel::with(['penilai:id,name','pelantik:id,name'])->paginate(10);
        return $penilaians;
    }
}
