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
    
    public function createLaporan(Request $request,$permohonan,$attached)
    {   
         //get the role of the current user
    $role = auth()->user()->role;
    //get filenametoStore directory from a function in the class
    $attachedLocation = $this->getFileNameToStore($role);

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
        $path =$request ->file($attached)->storeAs($attachedLocation,$fileNameToStore);
    
    }
        else{
            $fileNameToStore = 'noPDF.pdf';
        }
        
        $laporan = new Laporan();
      
        $laporan->dokumen_permohonan_id= $permohonan->dokumen_permohonan()->dokumen_permohonan_id; //retrieve latest dokumen_permohonan_id from permohonan has many dokumen permohonans
        $laporan->id_penghantar= auth()->user()->id;
        $laporan->tajuk_fail=$fileNameWithExt;
        $laporan->tajuk_fail_link= $fileNameToStore;
        $laporan->versi_laporan= 1;
        $laporan->save();
       
      
    }
   

    public function uploadLaporan(Request $request,$attached,$laporan_id)
    {

    }

    public function getFileNameToStore($role)
    {

        switch ($role) {
            case 'pjk':
                    return 'public/laporan_pjk';
                break; 
            case 'senat':
                return 'public/perakuan_senat';
            break; 
            case 'penilai':
                    return 'public/laporan_panel_penilai';
                break; 
            case 'jppa':
                    return 'public/perakuan_jppa';
                break; 
            default:
                    return 'public/pdf_error';
                break;
        }
    }

   
    

    
    
}
