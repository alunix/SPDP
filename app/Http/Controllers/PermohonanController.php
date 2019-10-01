<?php

namespace SPDP\Http\Controllers;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use Illuminate\Http\Request;
use SPDP\Services\PermohonanClass;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Services\SenaraiPerakuan;
use SPDP\Services\ShowPermohonan;
use Redirect,Response;

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
        // return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$user->permohonans);
        return view ('fakulti.senarai_permohonan_dihantar')->with('permohonans',$user->permohonans);
    }

    public function showListPermohonanBaharu()
    {  
        $sp = new SenaraiPermohonan();
        return  $sp->index();
    }

    public function senaraiPerakuan()
    {
        $sp = new SenaraiPerakuan();
        return  $sp->senaraiPerakuan();
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
        return $permohonan = $pc->create($request);
    }  
    public function show($id)
    {   
        $permohonan= Permohonan::find($id);
        if($permohonan==null){
            abort(403,'Tidak dibenarkan');
         }
        $show = new ShowPermohonan();
        return $show->show($permohonan);
    }
   
    public function  showPelantikanPenilai($id)
    {
        $permohonan = Permohonan::find($id);
        $users = User::where('role','penilai')->get();
        $dp = DokumenPermohonan::where('permohonan_id',$permohonan->permohonan_id)->orderBy('versi', 'DESC')->first();
        return view ('pjk.pjk-melantik-penilai')->with('users',$users)->with('permohonan',$permohonan)->with('dp',$dp);
    }

  
    public function pelantikanPenilaiSubmit(PenilaianPJK $pp,Request $request, $id)
    {      
        $this->validate($request,[
            'checked' => 'required',
        ]);
        return $pp->pelantikanPenilaiSubmit($request,$id);
    }

    /*API START  */
    public function api_permohonanDihantar()
    {
        $id= auth()->user()->id;
        $permohonans = Permohonan::where('id_penghantar', $id )->orderBy('permohonan_id')->get();
        $A = [];
        for ($i = 0; $i<sizeof($permohonans); $i++){
            $A[$i]['permohonan_id'] = $permohonans[$i]->permohonan_id;
            $A[$i]['jenis'] = $permohonans[$i]->jenis_permohonan->jenis_permohonan_huraian;
            $A[$i]['bil_hantar'] = $permohonans[$i]->version_counts();
            $A[$i]['doc_title'] = $permohonans[$i]->doc_title;
            $A[$i]['nama'] = $permohonans[$i]->user->name;
            $A[$i]['created_at'] = $permohonans[$i]->created_at->format('h:i a d/m/Y');
            $A[$i]['status'] = $permohonans[$i]->status_permohonan->status_permohonan_huraian;
            $A[$i]['updated_at'] = $permohonans[$i]->updated_at->format('h:i a d/m/Y');
        }
        return response()->json($A);
    }
   

}
