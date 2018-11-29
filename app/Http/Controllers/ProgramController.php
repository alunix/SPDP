<?php

namespace SPDP\Http\Controllers;
use SPDP\Program;
use SPDP\User;
use SPDP\Penilain;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
   

    public function index()
    {
        $programs = Program::all();
        return view ('fakulti.fakulti-insert-permohonan')->with('programs',$programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(array $data)
    // {

    //     
    
    public function permohonanDihantar()
    {
        $programs = Program::all();
        return view ('fakulti.senarai-permohonan-dihantar')->with('programs',$programs);
    }

    // }

       public function showListProgramPengajian(Request $request)
     {

    
        $programs = Program::where('status_program','Belum disemak')->get();
        return view ('pjk-view-program-baharu')->with('programs',$programs);

     

     }

     public function showListPanelPenilai(Request $request,$id)
     {
        
        
     
     }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'lecturer_name' => 'required|string|max:20',
            'fakulti' => 'required|string|max:255',
            'jenis_permohonan' => 'required|string|max:255',
            'file_link' => 'required|file|max:1999',
        ]);
        
        $programs= new Program();
        $programs->create($request);        
        return redirect('/senarai-program-dihantar')->with('success','Cadangan program telah berjaya dimuat naik');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)  {
        /* Main function but mcm tak betul , testing other possibilities */
        $program= Program::find($id);
        $role=auth()->user()->type;

        if($role=="pjk")
            return view('posts/view-program-baharu')->with('program',$program);
        else
           return view('posts/view-program-baharu')->with('program',$program)->with('penilaian',$program->penilaian);
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $program = Program::find($id);
        $users = User::where('type','penilai')->get();
        return view ('pjk.pjk-melantik-penilai')->with('users',$users)->with('program',$program);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {      
        
        $this->validate($request,[

            'checked' => 'required',

        ]);
            /* Find permohonan id then change the status program */
            $program =Program::find($id);           
            $program -> status_program = 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai'; 
            $program -> save();
          
            //Get value of dokumen_id from program id to be used as foreign key in penilaian table
            $programID = $program->id;

            //Create a new penilaian in penilaian table
            $penilaians = new Penilaian();
            $penilaians->create($request,$programID);
            return redirect(url('/senarai-penilaian'));
    }

    public function submitListPanelPenilai(Request $request, $id)    { 

    }

   
   



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
