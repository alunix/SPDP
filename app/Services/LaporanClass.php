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
    public function createLaporan(Request $request,$penilaian,$attached)
    {   
        
        $laporan = new Laporan();
        $laporan->penilaian_id_laporan = $penilaian->id;
        $laporan->save();

        $laporan_id= $laporan->laporan_id;

        $uploadedLaporan= $this->uploadLaporan($request,$penilaian,$attached,$laporan_id);
        
        

       
        


      
    }
    
    public function createPerakuanPjk(Request $request,Permohonan $permohonan)
    {
      $penilaian = new Penilaian();
      $penilaian->dokumen_id= $permohonan->id;
      $penilaian->perakuan_pjk=  $role = auth()->user()->id;
      $penilaian->save();

      $laporan = new LaporanClass();
      


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
                 return 'public/pdf_error';
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
    public function update(Request $request,$id)
    {
         //Handle file upload
         if($request->hasFile('laporan_panel_penilai'))
        
         {
 
             $fileNameWithExt=$request -> file('laporan_panel_penilai')->getClientOriginalName();
 
         // Get the full file name
             $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);            
 
         //Get the extension file name
             $extension = $request ->file('laporan_panel_penilai')-> getClientOriginalExtension();
         //File name to store
             $fileNameToStore=$filename.'_'.time().'.'.$extension;
         
         //Upload Pdf file
             $path =$request ->file('laporan_panel_penilai')->storeAs('public/laporan_panel_penilai',$fileNameToStore);
         
         }
             else{
                 $fileNameToStore = 'noPDF.pdf';
             }
 
 
             //Add laporan panel penilai to the penilaian table
 
            
             /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
             $permohonan= Permohonan::find($id);
             $penilaian = $permohonan->penilaian;
 
             /* Status semakan permohonan telah dikemaskini berdasarkan progress */
             $permohonan -> status_permohonan = 'Diluluskan oleh Panel Penilai(Laporan telah dikeluarkan dan akan dilampirkan oleh PJK)'; 
             $penilaian -> laporan_panel_penilai =$fileNameWithExt;
             $penilaian -> laporan_panel_penilai_link =$fileNameToStore;
 
             $permohonan ->save();
             $penilaian -> save();        
             
          
            
             
 
             
            
            //return redirect('/dashboard');
            return redirect('/');
    }

    public function updateLaporanPanel(Request $request, $id){

  
       

        //Handle file upload
        if($request->hasFile('perakuan_pjk'))
        
        {
            $fileNameWithExt=$request -> file('perakuan_pjk')->getClientOriginalName();
        // Get the full file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);            
        //Get the extension file name
            $extension = $request ->file('perakuan_pjk')-> getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //Upload Pdf file
        $path =$request ->file('perakuan_pjk')->storeAs('public/perakuan_pjk',$fileNameToStore);
        }
            else{
                $fileNameToStore = 'noPDF.pdf';
            }
            //Add laporan panel penilai to the penilaian table
            /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $permohonan = $penilaian->permohonan;
            /* Status semakan permohonan telah dikemaskini berdasarkan progress */
            $permohonan -> status_permohonan = 'Perakuan PJK telah dilampirkan bersama laporan panel penilai (Akan disemak oleh pihak JPPA)'; 
            $penilaian -> perakuan_pjk =$fileNameWithExt;
            $penilaian -> perakuan_pjk_link =$fileNameToStore;
            $permohonan ->save();
            $penilaian -> save();    
            return redirect('/');

    }

    public function updatePerakuanPJK(Request $request, $id){

       

        //Handle file upload
        if($request->hasFile('perakuan_jppa'))
        {
            $fileNameWithExt=$request -> file('perakuan_jppa')->getClientOriginalName();

        // Get the full file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);            

        //Get the extension file name
            $extension = $request ->file('perakuan_jppa')-> getClientOriginalExtension();
        //File name to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        
        //Upload Pdf file
        $path =$request ->file('perakuan_jppa')->storeAs('public/perakuan_jppa',$fileNameToStore);
        
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
            $penilaian -> perakuan_jppa =$fileNameWithExt;
            $penilaian -> perakuan_jppa_link =$fileNameToStore;
            $permohonan ->save();
            $penilaian -> save();      
            return redirect('/');

    }

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


    public function store_panel_penilai(Request $request)
    {
        $user= new User();
        $user->name = $request -> input('name');
        $user->email = $request -> input('email');
        $user->role = 'penilai';
        $user->password= Hash::make('abcd123');
        $user->save();

        return redirect()->route('register.panel_penilai.show');
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
