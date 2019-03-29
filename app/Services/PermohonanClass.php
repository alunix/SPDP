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
use SPDP\Services\DokumenPermohonanClass;


class PermohonanClass 
{

    public function create(Request $request)
    {   
        //Handle file upload
        if($request->hasFile('file_link'))
        {
        $fileNameWithExt=$request -> file('file_link')->getClientOriginalName();
        // Get the full file name
        $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //Get the extension file name
        $extension = $request ->file('file_link')-> getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;        
        //Upload Pdf file
        $path =$request ->file('file_link')->storeAs('public/cadangan_permohonan_baharu',$fileNameToStore);
        }
            else{
                $fileNameToStore = 'noPDF.pdf';
            }

        //Permohonan baharu
        $user_id = auth()->user()->id;

        $permohonan= new Permohonan();
        $permohonan -> doc_title =$request -> input('doc_title');
        $permohonan -> jenis_permohonan_id =$request -> input('jenis_permohonan_id');
        $permohonan -> id_penghantar = $user_id;
        $permohonan -> status_permohonan_id = 1;
        $permohonan -> save();

        $dk = new DokumenPermohonanClass();
        return  $dk->create($permohonan,$fileNameWithExt,$fileNameToStore);

        //Create a new kemajuan permohonan for each progress
        $kp = new KemajuanPermohonanClass();
       return $kp->create($permohonan);
                  
        $msg = [
            'message' => 'Permohonan berjaya dihantar',
           ];  

           return redirect()->route('permohonan.dihantar', [$param])->with($msg);
    }

    public function storePermohonanTidakDilulus(KemajuanPermohonanClass $kp,Request $request,$id)
     {    
        
         //Handle file upload
         if($request->hasFile('laporan_pjk'))
        
         {
             $fileNameWithExt=$request -> file('laporan_pjk')->getClientOriginalName();
         // Get the full file name
             $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);            
         //Get the extension file name
             $extension = $request ->file('laporan_pjk')-> getClientOriginalExtension();
         //File name to store
         $fileNameToStore=$filename.'_'.time().'.'.$extension;
         //Upload Pdf file
         $path =$request ->file('laporan_pjk')->storeAs('public/laporan_pjk',$fileNameToStore);
         }
             else{
                 $fileNameToStore = 'noPDF.pdf';
             }
             //Add laporan PJK
             /* Cari permohonan ID
             
            
             /* Status semakan permohonan telah dikemaskini berdasarkan progress */
             $permohonan= Permohonan::find($id);
             $permohonan -> status_permohonan = 'Laporan tidak dilulus oleh PJK'; 
             $permohonan -> laporan_pjk =$fileNameWithExt;
             $permohonan -> laporan_pjk_link =$fileNameToStore;
             $permohonan ->save();

        //Create a new kemajuan permohonan for each progress
        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);

        
             
            
        
     
     }

   
}
