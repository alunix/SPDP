<?php

namespace SPDP\Http\Controllers;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SPDP\Services\PenilaianClass;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        
        /* Accessing penilaian relationship to check status permohonan which is in permohonan */    

        $penilaians = Penilaian::whereHas('permohonan', function($query){
                $query->where('status_permohonan','=', 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai)');           
      
        })->get();
        return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
    }
        public function penilaianPJK_JPPA()
        {
         
            $role = auth()->user()->role;
    
            if($role=='pjk'){

                $penilaians = Penilaian::whereHas('permohonan', function($query){
                    $query->where('status_permohonan','=',  'Diluluskan oleh Panel Penilai(Laporan telah dikeluarkan dan akan dilampirkan oleh PJK)');           
          
            })->get();

               return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
    
            }
        
            elseif($role=='jppa'){

                $penilaians = Penilaian::whereHas('permohonan', function($query){
                    $query->where('status_permohonan','=',   'Perakuan PJK telah dilampirkan bersama laporan panel penilai (Akan disemak oleh pihak JPPA)');           
                })->get();
                
                return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
            }

    }

    public function editLaporanPanel($id){

       $penilaian=Penilaian::find($id);
       
        $penilaian_id=$penilaian->id;
        $penilaian=Penilaian::find($penilaian_id);

        

        return view('pjk.lampiran-pjk')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian);

    }

    public function editPerakuanPJK($id){

        $penilaian=Penilaian::find($id);
        $penilaian_id=$penilaian->id;
        $penilaian=Penilaian::find($penilaian_id);
        
        return view('jppa.lampiran-perakuan-jppa')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian);
     }

     public function editPerakuanJPPA($id){

        $penilaian=Penilaian::find($id);        
        $penilaian_id=$penilaian->id;
        $penilaian=Penilaian::find($penilaian_id);
        return view('jppa.lampiran-perakuan-jppa')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showpermohonanPenilai()
    {
        
        $permohonans = Permohonan::where('status_permohonan','Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai')->get();
        return view ('panel_penilai.senarai-permohonan-baharu')->with('permohonans',$permohonans);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
    }       

    /**
     * Display the specified resource.
     *
     * @param  \SPDP\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian,$id,permohonan $permohonan) /* Trying to pass two parameters which are $penilaian and $permohonan */
    {
        /* Main function but mcm tak betul , testing other possibilities */

  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SPDP\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permohonan = Permohonan::find($id);
        return view('panel_penilai.panel-lulus-permohonan')->with('penilaian',$permohonan->penilaian)->with('permohonan',$permohonan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'laporan_panel_penilai' => 'required|file|max:1999',
        ]);
        
        // //Trying to move method from controller to model 24/11/2018
        // $permohonan= permohonan::find($id);
        // $permohonan->updatePenilaianPJK($request);
        // Penilaian::where('id', $id)->updatePenilaianPJK($request->all());

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
            $permohonan= permohonan::find($id);
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

    public function updateLaporanPanel(PenilaianClass $pc,Request $request, $id){

        $this->validate($request,[
            'perakuan_pjk' => 'required|file|max:1999',
        ]);
        
        return $pc->updateLaporanPanel($request,$id);

    }

    public function updatePerakuanPJK(Request $request, $id){

        $this->validate($request,[
            'perakuan_jppa' => 'required|file|max:1999',
        ]);

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

        $this->validate($request,[
            'perakuan_senat' => 'required|file|max:1999',
        ]);

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

    public function create_panel_penilai()
    {  
        $users = User::where('role','penilai')->get();
       return view ('pjk.daftar-panel-penilai')->with('users',$users);
    }


    public function store_panel_penilai(PenilaianClass $pc,Request $request)
    {   
        return $pc->store_panel_penilai($request);
        
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
