<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\MuatNaikLaporan;


class RedirectPermohonan
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(Permohonan $permohonan)
    {
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
        switch ($jp) {
            case 'program_baharu':
                    return view('jenis_permohonan_view.program-pengajian-baharu')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);;
            break;
            case 'semakan_program':
            return view('jenis_permohonan_view.program_pengajian_baharu');
            break; 
            case 'kursus_teras_baharu':
            return view('jenis_permohonan_view.program_pengajian_baharu');
            break; 
            case 'kursus_elektif_baharu':
            return view('jenis_permohonan_view.program_pengajian_baharu');
            break; 
            case 'semakan_kursus_teras':
            return view('jenis_permohonan_view.program_pengajian_baharu');
                break; 
            case 'semakan_kursus_elekttif':
            return view('jenis_permohonan_view.program_pengajian_baharu');
                break; 
            case 'akreditasi_penuh':
            return view('jenis_permohonan_view.program_pengajian_baharu');
                break; 
            case 'penjumudan_program':
            return view('jenis_permohonan_view.penjumudan_program');
            break; 
            default:
                    return view ('/home'); 
                break;
        }
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
        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);
                  
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
          $kp = new KemajuanPermohonanClass();
          $kp->create($permohonan);
         

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
