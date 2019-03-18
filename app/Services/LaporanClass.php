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
    
    public function createLaporan(Request $request,$penilaian,$attached)
    {   
        
        $laporan = new Laporan();
        $laporan->penilaian_id_laporan = $penilaian->id;
        $laporan->save();

        $laporan_id= $laporan->laporan_id;

        $uploadedLaporan= $this->uploadLaporan($request,$penilaian,$attached,$laporan_id);
      
    }
   

    public function uploadLaporan(Request $request,$penilaian,$attached,$laporan_id)
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

     $laporan = Laporan::find($laporan_id);
     
     switch ($role) {
         case 'pjk':
         $laporan->perakuan_pjk= $filename;
         $laporan->perakuan_pjk_link= $fileNameToStore;
            break; 
         case 'senat':
         $laporan->perakuan_senat= $filename;
         $laporan->perakuan_senat_link= $fileNameToStore;
            break; 
         case 'penilai':
         $laporan->laporan_panel_penilai = $filename;
         $laporan->laporan_panel_penilai_link= $fileNameToStore;
             break; 
         case 'jppa':
         $laporan->perakuan_jppa= $filename;
         $laporan->perakuan_jppa_link= $fileNameToStore;
             break; 
         default:
                 return ;
             break;
     }
     $laporan->save();

    //  return $laporan;

    }

    public function getFileNameToStore($role)
    {
        // $role = auth()->user()->role;

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
