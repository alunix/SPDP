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
        $dp->versi = 1;
        $dp->save();

        // return redirect('/senarai-permohonan-dihantar')->with($msg);
    }

    
    public function update($permohonan,Request $request,$attached)
    {   
        
        //Handle file upload
        if($request->hasFile($attached))
        {
        $fileNameWithExt=$request->file($attached)->getClientOriginalName();
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
                
        $dp = new DokumenPermohonan();
        $dp->permohonan_id= $permohonan->permohonan_id;
        $dp->file_name = $fileNameWithExt;
        $dp->file_link=$fileNameToStore;
        $dp->file_size=$fileSize/1000;
        $dp ->komen =$request -> input('summary-ckeditor');
        $dp->versi =((int)$permohonan->version_counts())+1;
        $dp->save();

        $permohonan->status_permohonan_id= $this->getStatusPermohonan($permohonan->permohonan_id);
        $permohonan->save();

        $kp= new KemajuanPermohonanClass();
        $kp->create($permohonan);


      
    }

    public function getStatusPermohonan($permohonan_id)
    {
        switch ($permohonan_id) {
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


    public function show($id)
    {
        $permohonan= Permohonan::find($id);
        return view('fakulti.kemajuan-permohonan')->with('kjs',$permohonan->kemajuan_permohonans)->with('permohonan',$permohonan)->with('dokumen_permohonans',$permohonan->dokumen_permohonans);

    }

   


   

   
}
