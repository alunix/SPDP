<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\MuatNaikLaporan;
use SPDP\DokumenPermohonan;


class DokumenPermohonanClass 
{

    public function create($permohonan,$fileNameWithExt,$fileNameToStore,$request,$fileSize)
    {   

      
        $dp = new DokumenPermohonan();
        $dp->permohonan_id= $permohonan->permohonan_id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link=$fileNameToStore;
        $dp->file_size=$fileSize/1000;
        $dp ->komen =$request -> input('summary-ckeditor');
        $dp->versi = 1.0;
        $dp->save();

        // return redirect('/senarai-permohonan-dihantar')->with($msg);
    }

    
    public function update($permohonan,$request,$attached)
    {   
        //Handle file upload
        if($request->hasFile($attached))
        {
        $fileNameWithExt=$request -> file($attached)->getClientOriginalName();
        // Get the full file name
        $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //Get the extension file name
        $extension = $request ->file($attached)-> getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;        
        //Upload Pdf file
        $path =$request ->file($attached)->storeAs('public/cadangan_permohonan_baharu',$fileNameToStore);
        }
            else{
                $fileNameToStore = 'noPDF.pdf';
            }
        $fileSize = $request->file($attached)->getSize();


        $dk = DokumenPermohonan::where('permohonan_id',$permohonan->permohonan_id)->get();
        $version_count = count($dk);

        $dp = new DokumenPermohonan();
        $dp->permohonan_id= $permohonan->permohonan_id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link=$fileNameToStore;
        $dp->file_size=$fileSize;
        $dp -> komen =$request -> input('summary-ckeditor');
        $dp->versi = $version_count+1.0;
        $dp->save();



        return redirect('/senarai-permohonan-dihantar')->with($msg);
    }

    public function show(KemajuanPermohonan $kj,$id)
    {
        $permohonan= Permohonan::find($id);
        return view('fakulti.kemajuan-permohonan')->with('kjs',$permohonan->kemajuan_permohonans)->with('permohonan',$permohonan)->with('dokumen_permohonans',$permohonan->dokumen_permohonans);

    }


   

   
}
