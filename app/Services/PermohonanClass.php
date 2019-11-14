<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\User;
use SPDP\TetapanAliranKerja;
use Illuminate\Http\Request;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\DokumenPermohonanClass;
use SPDP\Services\LaporanClass;
use SPDP\Notifications\PerluPenambahbaikkan;
use Notification;
use SPDP\Services\NotificationClass;
use SPDP\Notifications\PermohonanBaharu;

class PermohonanClass
{

    public function create(Request $request)
    {
        //Handle file upload
        if ($request->hasFile('fail_permohonan')) {
            $fileNameWithExt = $request->file('fail_permohonan')->getClientOriginalName();
            // Get the full file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension file name
            $extension = $request->file('fail_permohonan')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Pdf file
            $path = $request->file('fail_permohonan')->storeAs('public/permohonan', $fileNameToStore);
        } else {
            $fileNameToStore = 'noPDF.pdf';
        }
        $fileSize = $request->file('fail_permohonan')->getSize();

        //Permohonan baharu
        $user_id = auth()->user()->id;

        $permohonan = new Permohonan();
        $permohonan->doc_title = $request->input('nama_program');
        $permohonan->jenis_id = $request->input('jenis_permohonan');
        $permohonan->id_penghantar = $user_id;
        $permohonan->status_permohonan_id = 1;
        $permohonan->save();

        $dk = new DokumenPermohonanClass();
        $dk->create($permohonan, $fileNameWithExt, $fileNameToStore, $request, $fileSize);

        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);

        // //Hantar email kepada pemeriksa        
        // if ($permohonan->jenis_id == 8)
        //     $email = TetapanAliranKerja::all()->first()->jppa->email;
        // else
        //     $email = TetapanAliranKerja::all()->first()->pjk->email;

        // $pemeriksa = User::where('email', $email)->first();
        // Notification::route('mail', $pemeriksa->email)->notify(new PermohonanBaharu($permohonan, $pemeriksa)); //hantar email kepada penghantar

        return response()->json('Success');
    }

    public function storePermohonanTidakDilulus(Request $request, $id)
    {
        $attached = 'dokumen';
        $permohonan = Permohonan::findOrFail($id);

        $laporan = new LaporanClass();
        $laporan->createLaporan($request, $permohonan, $attached);

        $permohonan->status_permohonan_id = $this->getStatusPenambahbaikkan();
        $permohonan->save();

        //Create a new kemajuan permohonan for each progress
        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);

        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail', $penghantar->email)->notify(new PerluPenambahbaikkan($permohonan, $penghantar)); //hantar email kepada penghantar

        $msg = [
            'message' => 'Laporan berjaya dimuat naik',
        ];

        return redirect()->route('home')->with($msg);
    }

    public function getStatusPenambahbaikkan()
    {
        $role = auth()->user()->role;

        switch ($role) {

            case 'pjk':
                return 9;
                break;
            case 'senat':
                return 11;
                break;
            case 'penilai':
                return 8;
                break;
            case 'jppa':
                return 10;
                break;
            default:
                return;
                break;
        }
    }
}
