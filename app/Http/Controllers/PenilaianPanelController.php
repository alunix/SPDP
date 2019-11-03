<?php

namespace SPDP\Http\Controllers;

use SPDP\PenilaianPanel;

class PenilaianPanelController extends Controller
{
    public function index()
    {
        $penilaians = PenilaianPanel::with(['user.fakulti:fakulti_id,fnama_kod', 'jenis_permohonan:id,jenis_permohonan_huraian', 'status_permohonan:status_id,status_permohonan_huraian'])->paginate(10);
        return $penilaians;
    }
}
