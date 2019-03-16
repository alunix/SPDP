<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianClass 
{
    
    public function create($permohonan)
    {   
        
        $role =auth()->user()->role;
        $user_id = auth()->user()->id;

       

        $penilaian = new Penilaian();
        $penilaian->dokumen_id= $permohonan->id;

        switch ($role) {
            case 'pjk':
            $penilaian->penilaian_pjk= $user_id;
            break;
            case 'jppa':
            $penilaian->penilaian_jppa=$user_id;
                break; 
            default:
                    return null;
                break;
        }
        $penilaian->status_penilaian=1;
        $penilaian->save();

        return $penilaian;

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
