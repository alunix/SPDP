<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;

class PermohonanClass 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
          $permohonan -> file_name = $fileNameWithExt;
          $permohonan -> file_link = $fileNameToStore;
          $permohonan -> id_penghantar = $user_id;
          $permohonan -> status_permohonan = ('Belum disemak');
          $permohonan -> save();

           //Create a new kemajuan permohonan for each progress
         $kj = new KemajuanPermohonan();
         $kj-> permohonan_id = $permohonan->id;
         $kj-> status_permohonan= $permohonan->status_permohonan;
         $kj->save();

        $msg = [
            'message' => 'Permohonan berjaya dihantar',
           ];  

        return redirect('/senarai-permohonan-dihantar')->with($msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storePermohonanTidakDilulus(Request $request,$id)
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
         $kj = new KemajuanPermohonan();
         $kj-> permohonan_id = $permohonan->id;
         $kj-> status_permohonan= $permohonan->status_permohonan;
         $kj->save();
             
            
        
     
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
    public function update(Request $request, $id)
    {
         /* Find permohonan id then change the status permohonan */
         $permohonan =Permohonan::find($id);           
         $permohonan -> status_permohonan = 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai'; 
         $permohonan -> save();

        //Create a new kemajuan permohonan for each progress
         $kj = new KemajuanPermohonan();
         $kj-> permohonan_id = $permohonan->id;
         $kj-> status_permohonan= $permohonan->status_permohonan;
         $kj->save();
         

         //Create a new penilaian in penilaian table
         $penilaians = new Penilaian();
         $selectedPenilai = $request->input('checked');
         $penilaianPJK = auth()->user()->id;
        
         $penilaians -> dokumen_id = $permohonan->id;
         $penilaians -> penilaian_pjk = $penilaianPJK;
         $penilaians -> penilaian_panel_1= $selectedPenilai[0];
         $penilaians -> save();
   
         
         return redirect(url('/senarai-penilaian'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function destroy(A $a)
    {
        //
    }
}
