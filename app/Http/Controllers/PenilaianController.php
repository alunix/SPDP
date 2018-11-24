<?php

namespace SPDP\Http\Controllers;

use SPDP\Penilaian;
use SPDP\Program;
use SPDP\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        
        /* Acceesing penilaian relationship to check status program which is in Program */    

        $penilaians = Penilaian::whereHas('program', function($query){
                $query->where('status_program','=', 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai)');           
      
        })->get();
        return view('pjk.senarai-penilaian-program')->with('penilaians',$penilaians);
    }
        public function penilaianPJK_JPPA()
        {
         
            $role = auth()->user()->type;
    
            if($role=='pjk'){
              

                $penilaians = Penilaian::whereHas('program', function($query){
                    $query->where('status_program','=',  'Diluluskan oleh Panel Penilai(Laporan telah dikeluarkan dan akan dilampirkan oleh PJK)');           
          
            })->get();
    
    
              
              
               
               return view('pjk.senarai-penilaian-program')->with('penilaians',$penilaians);
              
       
    
            }
        
            elseif($role=='jppa'){

                $penilaians = Penilaian::whereHas('program', function($query){
                    $query->where('status_program','=',   'Perakuan PJK telah dilampirkan bersama laporan panel penilai (Akan disemak oleh pihak JPPA)');           

                
              
                })->get();
                
                return view('pjk.senarai-penilaian-program')->with('penilaians',$penilaians);
            }
        

        
        

       
        
        
      

    }

    public function editLaporanPanel($id){

       $penilaian=Penilaian::find($id);
       
        $penilaian_id=$penilaian->id;
        $penilaian=Penilaian::find($penilaian_id);

      


       
       
       
        return view('pjk.lampiran-pjk')->with('program',$penilaian->program)->with('penilaian',$penilaian);

   
   
        
    }

    public function editPerakuanPJK($id){

        $penilaian=Penilaian::find($id);
        
         $penilaian_id=$penilaian->id;
         $penilaian=Penilaian::find($penilaian_id);      
 
 
        
        
        
         return view('jppa.lampiran-perakuan-jppa')->with('program',$penilaian->program)->with('penilaian',$penilaian);
 
    
    
         
     }

     public function editPerakuanJPPA($id){

        $penilaian=Penilaian::find($id);
        
         $penilaian_id=$penilaian->id;
         $penilaian=Penilaian::find($penilaian_id);      
 
 
        
        
        
         return view('jppa.lampiran-perakuan-jppa')->with('program',$penilaian->program)->with('penilaian',$penilaian);
 
    
    
         
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProgramPenilai()
    {
        // $programs = Program::where('status_program','Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai')->get();

        $programs = Program::where('status_program','Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai')->get();
        return view ('pjk-view-program-baharu')->with('programs',$programs);
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
    public function show(Penilaian $penilaian,$id,Program $program) /* Trying to pass two parameters which are $penilaian and $program */
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
        
        
        $program = Program::find($id);
        // $programID= $program->id;
        // $program=Program::find($programID);
        return view('panel_penilai.panel-lulus-permohonan')->with('penilaian',$program->penilaian)->with('program',$program);

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SPDP\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

           
            'laporan_panel_penilai' => 'required|file|max:1999',
           


        ]);
        
        //Trying to move method from controller to model 24/11/2018
        $penilaian= Penialain::find($id);
        $penilaian->updatePenilaianPJK($request);

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

           
            /* Cari program since penilaian belongs to program then baru boleh cari penilaian through eloquent relationship */
            $program= Program::find($id);
            $penilaian = $program->penilaian;

            /* Status semakan program telah dikemaskini berdasarkan progress */
            $program -> status_program = 'Diluluskan oleh Panel Penilai(Laporan telah dikeluarkan dan akan dilampirkan oleh PJK)'; 

            $penilaian -> laporan_panel_penilai =$fileNameWithExt;
            $penilaian -> laporan_panel_penilai_link =$fileNameToStore;

            $program ->save();
            $penilaian -> save();        
            
         
           
            

            
           
           //return redirect('/dashboard');
           return redirect('/');
    }

    public function updateLaporanPanel(Request $request, $id){

        $this->validate($request,[

           
            'perakuan_pjk' => 'required|file|max:1999',
           


        ]);

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

           
            /* Cari program since penilaian belongs to program then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $program = $penilaian->program;

           

            /* Status semakan program telah dikemaskini berdasarkan progress */
            $program -> status_program = 'Perakuan PJK telah dilampirkan bersama laporan panel penilai (Akan disemak oleh pihak JPPA)'; 

            $penilaian -> perakuan_pjk =$fileNameWithExt;
            $penilaian -> perakuan_pjk_link =$fileNameToStore;

            $program ->save();
            $penilaian -> save();        
            
         
           
            

            
           
          
           return redirect('/');

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

           
            /* Cari program since penilaian belongs to program then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $program = $penilaian->program;

           

            /* Status semakan program telah dikemaskini berdasarkan progress */
            $program -> status_program = 'Perakuan JPPA telah dilampirkan, permohonan akan dihantar kepada pihak Senat'; 

            $penilaian -> perakuan_jppa =$fileNameWithExt;
            $penilaian -> perakuan_jppa_link =$fileNameToStore;

            $program ->save();
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

           
            /* Cari program since penilaian belongs to program then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $program = $penilaian->program;

           

            /* Status semakan program telah dikemaskini berdasarkan progress */
            $program -> status_program = 'Perakuan JPPA telah dilampirkan, permohonan akan dihantar kepada pihak Senat'; 

            $penilaian -> perakuan_senat =$fileNameWithExt;
            $penilaian -> perakuan_senat_link =$fileNameToStore;

            $program ->save();
            $penilaian -> save();        
            
         
           
            

            
           
          
           return redirect('/');

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
