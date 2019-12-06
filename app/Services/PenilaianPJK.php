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
    public function createPerakuanPjk(Request $request, $permohonan)
    {
        $permohonan = Permohonan::find($permohonan->id);
        $permohonan->status_id = $this->getStatusPermohonan($permohonan);
        $permohonan->save();

        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail', $penghantar->email)->notify(new PermohonanDiluluskan($permohonan, $penghantar)); //hantar email kepada penghantar

        //If permohonan perlu diluluskan oleh JPPA
        if ($permohonan->status_id == 4) {
            $email = TetapanAliranKerja::all()->first()->email_jppa;
            $pemeriksa = User::where('email', $email)->first();
            Notification::route('mail', $pemeriksa->email)->notify(new PermohonanBaharu($permohonan, $pemeriksa));
        }

        $kj = new CreateKemajuan();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Laporan berjaya dimuat naik',
        ];
        return redirect()->route('home')->with($msg);
    }

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

    public function getStatusPermohonan($permohonan)
    {
        $jp = $permohonan->jenis_permohonan->kod;
        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program':
                if ($permohonan->status_id == 1)
                    return 2; //if no laporan are found that means permohonan masih disemak oleh panel penilai
                else
                    return 4;
                break;
            case 'kursus_teras_baharu':
            case 'semakan_kursus_teras': 
                return 4;
                break;
            case 'kursus_elektif_baharu':
            case 'semakan_kursus_elektif':
                return 7;
                break;
            default:
                return;
                break;
        }
    }

    public function showPerakuanPjk($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $jp = $permohonan->jenis_permohonan->kod;
        $status_id = $permohonan->value('status_id');

        switch ($jp) {
            case 'program_baharu':
                return $this->viewProgramBaharu($id);
                break;
            case 'kursus_teras_baharu':
            case 'kursus_elektif_baharu':
                return $this->viewKursusTerasElektifBaharu($id);
                break;
            case 'semakan_kursus_teras':
            case 'semakan_kursus_elektif':
            case 'semakan_program':
                if ($status_id == '1') // if permohonan require minority changes then create a new perakuan
                    return $this->viewKursusTerasElektifBaharu($id);
                else if ($status_id == '3')
                    return  $this->viewProgramBaharu($id);
                break;
            default:
                return;
                break;
        }
    }


    public function uploadPerakuanPjk($request, $permohonan)
    {
        $jp = $permohonan->jenis_permohonan->kod;

        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program':
                return $this->updateLaporanPanel($request, $permohonan);
                break;
            case 'kursus_teras_baharu':
            case 'kursus_elektif_baharu':
                return $this->createPerakuanPjk($request, $permohonan);
                break;
            case 'semakan_kursus_teras':
            case 'semakan_kursus_elektif':
                return $this->semakanKursus($request, $permohonan);
                break;
            default:
                return;
                break;
        }
    }

    public function updateLaporanPanel(Request $request, $permohonan)
    {
        //Upload perakuan
        $attached = 'perakuan_pjk';
        $laporan = new LaporanClass();
        $laporan->createLaporan($request, $permohonan, $attached);

        /*Status semakan permohonan telah dikemaskini berdasarkan progress */
        $permohonan->status_id = $this->getStatusPermohonan($permohonan);
        $permohonan->save();

        //Hantar email kepada penghantar dan next pemeriksa
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail', $penghantar->email)->notify(new PermohonanDiluluskan($permohonan, $penghantar));

        //If permohonan perlu diluluskan oleh JPPA
        if ($permohonan->status_id == 4) {
            $id_jppa = TetapanAliranKerja::all()->first()->id_jppa;
            $pemeriksa = User::find($id_jppa);
            Notification::route('mail', $pemeriksa->email)->notify(new PermohonanBaharu($permohonan, $pemeriksa));
        }

        //Kemajuan permohonan baharu
        $kj = new CreateKemajuan();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Perakuan berjaya dimuatnaik',
        ];

        return redirect()->route('home')->with($msg);
    }

    public function semakanKursus(Request $request, $permohonan)
    {
        $status_permohonan = $permohonan->status_permohonan_id;
        if ($status_permohonan == '1') // if permohonan require minority changes then create a new perakuan
            return $this->createPerakuanPjk($request, $permohonan);
        else if ($status_permohonan == '3')
            return $this->updateLaporanPanel($request, $permohonan);
        else
            return;
    }
}
