<?php

namespace SPDP\Http\Controllers;
use SPDP\Program;
use SPDP\User;
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
        return view ('posts/fakulti-insert-programs')->with('programs',$programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(array $data)
    // {

    //     
        

    // }

       public function showListProgramPengajian(Request $request)
     {

    
        $programs = Program::where('status_program','Belum disemak')->get();
        
        return view ('pjk-view-program-baharu')->with('programs',$programs);

     }

     public function showListPanelPenilai(Request $request,$id)
     {
        
         $program = Program::find($id);
       
         $users = User::where('type','penilai')->get();

      

        // $users= User::all();
         return view ('posts/pjk-melantik-penilai')->with('users',$users)->with('program',$program);
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
            'file_link' => 'required|file|max:1999',
           


        ]);

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
        $path =$request ->file('file_link')->storeAs('public/cadangan_program_baharu',$fileNameToStore);
        
        }
            else{
                $fileNameToStore = 'noPDF.pdf';
            }
            

        


        //Create a new Program

        $lecturer_id = auth()->user()->id;
        $lecturer_name= auth()->user()->name;
       
            
            $programs = new Program();
            $programs -> lecturer_name = $request -> input('lecturer_name');
            $programs -> fakulti = $request -> input('fakulti');
            $programs -> doc_title =$request -> input('doc_title');
            $programs -> file_name = $fileNameWithExt;
            $programs -> file_link = $fileNameToStore;
            $programs -> lecturer_id = $lecturer_id;
            $programs -> status_program = ('Belum disemak');
            

            $programs -> save();

            return redirect('/program-baharu')->with('success','Cadangan program telah berjaya dimuat naik');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
       
        
         $program = Program::find($id);
        return view('posts/view-program-baharu')->with('program',$program);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {      
        
        


       
            
            /* Find permohonan id then change the status program */
            $program =Program::find($id);           
            $program -> status_program = 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai'; 
            $program -> save();

            

           

            return redirect()->route('/dashboard');

          
        

            


        

    }

    public function submitListPanelPenilai(Request $request, $id)    {      
            
            $program =Program::find($id);
            
            
            $program -> status_program = 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai'; 
           
            

            $program -> save();

            // return redirect('/dashboard');

            return redirect('/programs/{program}/pelantikan-penilai')->with('program',$program);
            
           
        

            


        

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
