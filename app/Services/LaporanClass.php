<?php

namespace SPDP\Services;

use SPDP\User;
use SPDP\Laporan;
use Illuminate\Http\Request;
use Notification;
use SPDP\Notifications\PermohonanBaharu;
use SPDP\Notifications\PermohonanDiluluskan;
use SPDP\TetapanAliranKerja;

class LaporanClass
{
    public function storeLaporan(Request $request, $permohonan)
    {
        $attachedLocation = 'public/laporan';
        $laporan = 'laporan';

        if ($request->hasFile($laporan)) {
            $fileNameWithExt = $request->file($laporan)->getClientOriginalName();
            // Get the full file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($laporan)->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Pdf file
            $path = $request->file($laporan)->storeAs($attachedLocation, $fileNameToStore);
        } else {
            $fileNameToStore = 'noPDF.pdf';
        }

        # add laporan data to database
        $this->createLaporanObject($permohonan, $fileNameWithExt, $fileNameToStore, $request);

        # check checkbox kelulusan
        $kelulusan = $request->input('kelulusan');
        if ($kelulusan == "true") {
            return $this->permohonanLulus($permohonan);
        } else {
            return $this->permohonanTidakLulus($permohonan);
        }
    }

    private function createLaporanObject($permohonan, $fileNameWithExt, $fileNameToStore, $request)
    {
        $user_id = auth()->user()->id;
        $laporan_count = $this->getAmountOfLaporan($permohonan);

        $laporan = new Laporan();
        $laporan->dokumen_permohonan_id = $permohonan->latest_dokumen()->dokumen_permohonan_id; //retrieve latest dokumen_permohonan_id from permohonan has many dokumen permohonans
        $laporan->id_penghantar = auth()->user()->id;
        $laporan->komen = $request->input('komen');
        $laporan->tajuk_fail = $fileNameWithExt;
        $laporan->tajuk_fail_link = $fileNameToStore;
        $laporan->versi = $laporan_count + 1;
        $laporan->save();
    }

    private function getAmountOfLaporan($permohonan)
    {
        $user_id = auth()->user()->id;
        $laporans_id = $permohonan->dokumens->pluck('dokumen_permohonan_id');
        $laporans = Laporan::where('id_penghantar', $user_id)->whereIn('dokumen_permohonan_id', $laporans_id)->count();
        return $laporans;
    }

    private function permohonanLulus($permohonan)
    {
        $permohonan->status_id = $this->getStatusKelulusan($permohonan);
        $permohonan->save();
        $kp = new CreateKemajuan();
        $kp->create($permohonan);
        # hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail', $penghantar->email)->notify(new PermohonanDiluluskan($permohonan, $penghantar));
        return $this->sendEmailPemeriksa($permohonan);
    }

    private function permohonanTidakLulus($permohonan)
    {
        $permohonan->status_id = $this->getStatusPenambahbaikkan();
        $permohonan->save();
        $kp = new CreateKemajuan();
        $kp->create($permohonan);
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail', $penghantar->email)->notify(new PerluPenambahbaikkan($permohonan, $penghantar)); //hantar email kepada penghantar
    }

    private function sendEmailPemeriksa($permohonan)
    {
        $user = auth()->user();
        $role = $user->role;
        switch ($role) {
            case 'penilai':
                $id_pjk = TetapanAliranKerja::all()->first()->id_pjk;
                $pjk = User::find($id_pjk);
                Notification::route('mail', $pjk->email)->notify(new LaporanDikeluarkan($permohonan, $pjk, $user));
                break;
            case 'jppa':
                $id_senat = TetapanAliranKerja::all()->first()->id_senat;
                $senat = User::find($id_senat);
                Notification::route('mail', $senat->email)->notify(new PermohonanBaharu($permohonan, $senat));
                break;
            default:
                return;
        }
    }

    public function getLaporansDashboard()
    {
        $user_id = auth()->user()->id;
        $dokumens_id = Laporan::where('id_penghantar', $user_id)->pluck('dokumen_permohonan_id')->toArray();
        $dokumens_id = array_unique($dokumens_id);
        $laporans = Laporan::with('id_penghantar_nama:id,role')
            ->whereIn('dokumen_permohonan_id', $dokumens_id)
            ->where('id_penghantar', '!=', $user_id)
            ->orderBy('created_at', 'desc')
            ->take(5)->get();
        return $laporans;
    }

    private function getStatusKelulusan($permohonan)
    {
        $role = auth()->user()->role;
        $jp = $permohonan->jenis_permohonan->kod;

        if ($role == 'pjk') {
            switch ($jp) {
                case 'program_baharu':
                case 'semakan_program': //same condition yang akan lalui panel penilai
                case 'kursus_teras_baharu':
                case 'semakan_kursus_teras': //will figure out the rest 3/3/2019
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
        } else {
            switch ($role) {
                case 'penilai':
                    return 3;
                    break;
                case 'jppa':
                    return 5;
                    break;
                case 'senat':
                    return 6;
                    break;
                default:
                    return;
            }
        }
    }

    private function getStatusPenambahbaikkan()
    {
        $role = auth()->user()->role;

        switch ($role) {

            case 'penilai':
                return 8;
                break;
            case 'pjk':
                return 9;
                break;
            case 'jppa':
                return 10;
                break;
            case 'senat':
                return 11;
                break;
            default:
                return;
                break;
        }
    }
}
