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
        $permohonan->status_id = 1;
        $permohonan->save();

        $dk = new DokumenPermohonanClass();
        $dk->create($permohonan, $fileNameWithExt, $fileNameToStore, $request, $fileSize);

        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);

        // //Hantar email kepada pemeriksa        
        if ($permohonan->jenis_id == 8)
            $email = TetapanAliranKerja::all()->first()->jppa->email;
        else
            $email = TetapanAliranKerja::all()->first()->pjk->email;

        $pemeriksa = User::where('email', $email)->first();
        Notification::route('mail', $pemeriksa->email)->notify(new PermohonanBaharu($permohonan, $pemeriksa)); //hantar email kepada penghantar

        return response()->json('Success');
    }
}
