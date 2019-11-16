<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LaporanClass
{
    public function createLaporan(Request $request, $permohonan)
    {
        //get filenametoStore directory from a function in the class
        $attachedLocation = 'public/laporan';
        $laporan = $request->input('laporan');
        //Handle file upload
        if ($request->hasFile($laporan)) {
            $fileNameWithExt = $request->file($laporan)->getClientOriginalName();
            // Get the full file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get the extension file name
            $extension = $request->file($laporan)->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Pdf file
            $path = $request->file($laporan)->storeAs($attachedLocation, $fileNameToStore);
        } else {
            $fileNameToStore = 'noPDF.pdf';
        }
        //get the role of the current user
        $user_id = auth()->user()->id;
        $laporans_id = $permohonan->dokumens->pluck('dokumen_permohonan_id');
        $laporan_count = Laporan::where('id_penghantar', $user_id)->where('dokumen_permohonan_id', $laporans_id)->get();

        if ($laporans_id == null) {
            $laporan = new Laporan();
            $laporan->dokumen_permohonan_id = $permohonan->dokumen_permohonan()->dokumen_permohonan_id; //retrieve latest dokumen_permohonan_id from permohonan has many dokumen permohonans
            $laporan->id_penghantar = auth()->user()->id;
            $laporan->komen = $request->input('komen');
            $laporan->tajuk_fail = $fileNameWithExt;
            $laporan->tajuk_fail_link = $fileNameToStore;
            $laporan->versi = 1;
            $laporan->save();
        } else {
            $laporan = new Laporan();
            $laporan->dokumen_permohonan_id = $permohonan->dokumen_permohonan()->dokumen_permohonan_id; //retrieve latest dokumen_permohonan_id from permohonan has many dokumen permohonans
            $laporan->id_penghantar = auth()->user()->id;
            $laporan->komen = $request->input('komen');
            $laporan->tajuk_fail = $fileNameWithExt;
            $laporan->tajuk_fail_link = $fileNameToStore;
            $laporan->versi = count($laporan_count) + 1;
            $laporan->save();
        }
    }
}
