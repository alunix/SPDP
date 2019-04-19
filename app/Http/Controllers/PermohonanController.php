<?php

namespace SPDP\Http\Controllers;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SPDP\Services\PermohonanClass;
use SPDP\Services\RedirectPermohonan;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\ShowPermohonan;

class PermohonanController extends Controller
{
  
    public function index()
    {
        $permohonans = Permohonan::all();
        return view ('fakulti.fakulti-insert-permohonan')->with('permohonans',$permohonans);
    }
   
    public function permohonanDihantar()
    {   
        $user_id =auth()->user()->id;
        $user= User::find($user_id);
        return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$user->permohonans);
    }

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
        return view('laporan.permohonan-tidak-dilulus')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);
    }

     public function storePermohonanTidakDilulus(Request $request,$id)
     {    
        $this->validate($request,[
            'dokumen' => 'required|file|max:1999',
        ]);
        
        $permohonan = Permohonan::find($id);
        $pc = new PermohonanClass();
        $pc->storePermohonanTidakDilulus($request,$permohonan->permohonan_id);
        return redirect()->route('home');
     }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_penghantar' => 'required|string|max:20',
            'jenis_permohonan_id' => 'required|integer|max:255',
            'file_link' => 'required|mimes:pdf|max:1999',
        ]);
      
        $pc = new PermohonanClass();       
        return $pc->create($request);
    }  
    public function show($id)  {
        
        /* Main function but mcm tak betul , testing other possibilities */
        $permohonan= Permohonan::find($id);
        
          
        if($permohonan==null){
            abort(403,'Tidak dibenarkan');
         }

        $show = new ShowPermohonan();
        return $show->show($permohonan);
    }
   
    public function  showPelantikanPenilai($id) {

        $permohonan = Permohonan::find($id);
        $users = User::where('role','penilai')->get();
        $dp = DokumenPermohonan::where('permohonan_id',$permohonan->permohonan_id)->orderBy('versi', 'DESC')->first();
        return view ('pjk.pjk-melantik-penilai')->with('users',$users)->with('permohonan',$permohonan)->with('dp',$dp);
    }

  
    public function pelantikanPenilaiSubmit(PenilaianPJK $pp,Request $request, $id)    {      
        
        $this->validate($request,[
            'checked' => 'required',
        ]);
            return $pp->pelantikanPenilaiSubmit($request,$id);
    }

}
