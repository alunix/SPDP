<?php

namespace SPDP\Services;


use SPDP\Permohonan;
use SPDP\User;
use SPDP\Services\LaporanClass;
use SPDP\Services\CreatePenilaianPanel;
use SPDP\Services\CreateKemajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Notification;
use SPDP\Laporan;
use SPDP\Notifications\PermohonanBaharu;
use SPDP\Notifications\PelantikanPanelPenilai;
use SPDP\Notifications\PermohonanDiluluskan;
use SPDP\TetapanAliranKerja;
use Debugbar;


class PenilaianPJK
{
    public function pelantikanPenilaiSubmit(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status_id = 2;
        $permohonan->save();

        $kp = new CreateKemajuan();
        $kp->create($permohonan);

        $penilaian = new CreatePenilaianPanel();
        $penilaian = $penilaian->create($permohonan, $request);

        //Send email to panel penilai
        // $penilai = User::findOrFail($selectedPenilai[0]);
        // Notification::route('mail', $penilai->email)->notify(new PelantikanPanelPenilai($permohonan, $penilaian, $penilai)); //hantar email kepada panel penilai

    }
}
