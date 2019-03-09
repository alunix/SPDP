<?php

namespace SPDP\Http\Controllers;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SPDP\Services\PermohonanClass;
use SPDP\Services\RedirectPermohonan;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;

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
   
    public function permohonanDihantar()
    {   
        $user_id =auth()->user()->id;
        $user= User::find($user_id);
        return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$user->permohonans);

      
    }

    // }

       public function showListPermohonanBaharu()
     {  
        $sp = new SenaraiPermohonan();
        return  $sp->index();
     }

     public function senaraiPerakuanPjk()
     {
        $sp = new SenaraiPermohonan();
        return  $sp->perakuanPjk();
     }

     public function permohonanTidakDilulus(Request $request,$id)
     {
        $permohonan= Permohonan::find($id);
        return view('pjk.permohonan-tidak-dilulus')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);

        
     
     }

     public function storePermohonanTidakDilulus(PermohonanClass $pc,Request $request,$id)
     {    
        $this->validate($request,[

            'laporan_pjk' => 'required|file|max:1999',
        ]);
        
        $pc->storePermohonanTidakDilulus($request,$id);
        return redirect('/home');
        
     
     }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermohonanClass $pc,Request $request)
    {
        $this->validate($request,[

            'nama_penghantar' => 'required|string|max:20',
            'jenis_permohonan_id' => 'required|integer|max:255',
            'file_link' => 'required|mimes:pdf|max:1999',
        ]);
       
        return $pc->create($request);

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
       
        $rp = new RedirectPermohonan();
        return $rp->redirect($permohonan);

        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  showPelantikanPenilai($id)
    {
        $permohonan = Permohonan::find($id);
        $users = User::where('role','penilai')->get();
        return view ('pjk.pjk-melantik-penilai')->with('users',$users)->with('permohonan',$permohonan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pelantikanPenilaiSubmit(PenilaianPJK $pp,Request $request, $id)    {      
        
        $this->validate($request,[

            'checked' => 'required',

        ]);
            return $pp->pelantikanPenilaiSubmit($request,$id);
           
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
