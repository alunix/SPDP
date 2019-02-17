<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianSenat
{
    
   
    


  
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function show(A $a)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function edit(A $a)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
   

    
    public function updatePerakuanJPPA(Request $request, $id){

       
    
        //Handle file upload
        if($request->hasFile('perakuan_senat'))
        
        {
            $fileNameWithExt=$request -> file('perakuan_senat')->getClientOriginalName();
        // Get the full file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);  
        //Get the extension file name
            $extension = $request ->file('perakuan_senat')-> getClientOriginalExtension();
        //File name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //Upload Pdf file
            $path =$request ->file('perakuan_senat')->storeAs('public/perakuan_senat',$fileNameToStore);
        
        }
            else{
                $fileNameToStore = 'noPDF.pdf';
            }


            //Add laporan panel penilai to the penilaian table

           
            /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $permohonan = $penilaian->permohonan;

            /* Status semakan permohonan telah dikemaskini berdasarkan progress */
            $permohonan -> status_permohonan = 'Perakuan JPPA telah dilampirkan, permohonan akan dihantar kepada pihak Senat'; 
            $penilaian -> perakuan_senat =$fileNameWithExt;
            $penilaian -> perakuan_senat_link =$fileNameToStore;
            $permohonan ->save();
            $penilaian -> save();

            return redirect('/');

    }



    public function destroy(A $a)
    {
        //
    }
}