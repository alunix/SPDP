<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\Services\CreateKemajuan;
use SPDP\DokumenPermohonan;
use SPDP\Notifications\DokumenPenambahbaikkan;
use Notification;
use SPDP\TetapanAliranKerja;
use SPDP\User;


class DokumenClass
{

    public function create($permohonan, $fileNameWithExt, $fileNameToStore, $request, $fileSize)
    {
        $dp = new DokumenPermohonan();
        $dp->permohonan_id = $permohonan->id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link = $fileNameToStore;
        $dp->file_size = $fileSize / 1000;
        $dp->komen = $request->input('komen');
        $dp->versi = 1;
        $dp->save();
    }

    public function update($permohonan, Request $request, $attached)
    {
        //Handle file upload
        if ($request->hasFile($attached)) {
            $fileNameWithExt = $request->file($attached)->getClientOriginalName();
            // Get the full file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension file name
            $extension = $request->file($attached)->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Pdf file
            $path = $request->file($attached)->storeAs('public/permohonan', $fileNameToStore);
        } else {
            $fileNameToStore = 'noPDF.pdf';
        }

        $fileSize = $request->file($attached)->getSize();
        $dp = new DokumenPermohonan();
        $dp->permohonan_id = $permohonan->id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link = $fileNameToStore;
        $dp->file_size = $fileSize / 1000;
        $dp->komen = $request->input('komen');
        $dp->versi = ((int) $permohonan->version_counts()) + 1;
        $dp->save();

        $status_id = $permohonan->status_id;
        $permohonan->status_id = $this->getStatusPermohonan($status_id);
        $permohonan->save();

        $kp = new CreateKemajuan();
        $kp->create($permohonan);

        // $user = $this->getEmailPenambahbaikkan($permohonan, $status_id);
        //Hantar email kepada penghantar
        // Notification::route('mail', $user->email)->notify(new DokumenPenambahbaikkan($dp)); //hantar email kepada penghantar

        //$email = $this->getEmailPenambahbaikkan($permohonan,$status_id);
    }

    public function getStatusPermohonan($status_id)
    {
        switch ($status_id) {
            case 8:
                return 12;
                break;
            case 9:
                return 13;
                break;
            case 10:
                return 14;
                break;
            case 11:
                return 15;
                break;

            default:
                return;
                break;
        }
    }

    public function getEmailPenambahbaikkan($permohonan, $status_id)
    {
        switch ($status_id) {
            case 8:
                $panel = $permohonan->penilaian_panels->pluck('id_penilai');
                $user = User::findOrFail($panel);
                break;
            case 9:
                $tetapan = TetapanAliranKerja::all()->first();
                $id_user = $tetapan->value('id_pjk');
                $user = User::findOrFail($id_user);
                break;
            case 10:
                $tetapan = TetapanAliranKerja::all()->first();
                $id_user = $tetapan->value('id_jppa');
                $user = User::findOrFail($id_user);
                break;
            case 11:
                $tetapan = TetapanAliranKerja::all()->first();
                $id_user = $tetapan->value('id_senat');
                $user = User::findOrFail($id_user);
                break;
            default:
                return;
                break;
        }

        return $user;
    }
}
