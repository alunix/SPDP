<?php

namespace SPDP\Http\Controllers;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Penilain;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermohonanController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
   

    public function index()
    {
        $permohonans = Permohonan::all();
        return view ('fakulti.fakulti-insert-permohonan')->with('permohonans',$permohonans);
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
        $permohonans = Permohonan::all();
        return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$permohonans);
    }

    // }

       public function showListPermohonanPengajian(Request $request)
     {

    
        $permohonans = Permohonan::where('status_permohonan','Belum disemak')->get();
        return view ('pjk-view-permohonan-baharu')->with('permohonans',$permohonans);

     

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
            'jenis_permohonan_id' => 'required|integer|max:255',
            'file_link' => 'required|file|max:1999',
        ]);
        
        $permohonans= new Permohonan();
        $permohonans->create($request);        
        return redirect('/senarai-permohonan-dihantar')->with('success','Cadangan permohonan telah berjaya dimuat naik');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)  {
        /* Main function but mcm tak betul , testing other possibilities */
        $permohonan= Permohonan::find($id);
        $role=auth()->user()->type;

        if($role=="pjk")
            return view('posts/view-permohonan-baharu')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);
        else
           return view('posts/view-permohonan-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permohonan = Permohonan::find($id);
        $users = User::where('type','penilai')->get();
        return view ('pjk.pjk-melantik-penilai')->with('users',$users)->with('permohonan',$permohonan);
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
            /* Find permohonan id then change the status permohonan */
            $permohonan =Permohonan::find($id);           
            $permohonan -> status_permohonan = 'Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai'; 
            $permohonan -> save();
          
            //Get value of dokumen_id from permohonan id to be used as foreign key in penilaian table
            $permohonanID = $permohonan->id;

            //Create a new penilaian in penilaian table
            $penilaians = new Penilaian();
            $penilaians->create($request,$permohonanID);
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
