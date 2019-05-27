<?php

namespace SPDP\Http\Controllers;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SPDP\Services\PenilaianClass;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\PenilaianJppa;
use SPDP\Services\PenilaianSenat;
use SPDP\Services\PenilaianPenilai;

class PenilaianController extends Controller
{
  
    public function index()
    {
       $penilaians = Penilaian::all();
       /* Accessing penilaian relationship to check status permohonan which is in permohonan */    
        return view('pjk.senarai-penilaian-permohonan')->with('penilaians',$penilaians);
    }

    public function showPerakuanPjk($id)
    {
        $pp = new PenilaianPJK();
        return $pp->showPerakuanPjk($id);
    }

   

    public function uploadPerakuanPjk(Request $request,$id)
    {
        $this->validate($request,[
            'perakuan_pjk' => 'required|file|max:1999',
        ]);

        $permohonan = Permohonan::find($id);
        $penilaian = new PenilaianPJK();       
        return $penilaian->uploadPerakuanPjk($request,$permohonan);
     }

     public function showPerakuanJPPA($id){

        $permohonan =Permohonan::find($id);

        if($permohonan->jenis_permohonan_id!=8)
        return view('jppa.lampiran-perakuan-jppa')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
        else
        return view('jppa.lampiran-perakuan-penjumudan')->with('permohonan',$permohonan);

        
     }

     public function uploadPerakuanJppa(Request $request, $id){

        $this->validate($request,[
            'perakuan_jppa' => 'required|file|max:1999',
        ]);

        $permohonan= Permohonan::find($id);
        $pj= new PenilaianJppa();
        return $pj->uploadPerakuan($request,$permohonan);

    }
   
    public function showLaporanPenilai($id)
    {
        $permohonan = Permohonan::find($id);
        return view('panel_penilai.panel-lulus-permohonan')->with('penilaian',$permohonan->penilaian)->with('permohonan',$permohonan);
    }

  
    public function uploadLaporanPenilai(PenilaianPenilai $pp,Request $request,$id)
    {
        $this->validate($request,[
            'laporan_panel_penilai' => 'required|file|max:1999',
        ]);
        
        $permohonan =Permohonan::find($id);
        return $pp->uploadLaporanPenilai($request,$permohonan);
    }  

    public function showPerakuanSenat($id)
    {
        $pp = new PenilaianSenat();
        $permohonan =Permohonan::find($id);
        return $pp->showPerakuanSenat($permohonan);
    }

    public function uploadPerakuanSenat(Request $request, $id){

        $this->validate($request,[
            'perakuan_senat' => 'required|file|max:1999',
        ]);
       
        $permohonan =Permohonan::find($id);
        $pc = new PenilaianSenat();
        return $pc->uploadPerakuanSenat($request,$permohonan);

       
    }

    public function create_panel_penilai()
    {  
        $users = User::where('role','penilai')->get();
       return view ('pjk.daftar-panel-penilai')->with('users',$users);
    }


    public function store_panel_penilai(PenilaianClass $pc,Request $request)
    {    
        $this->validate($request,[
            'nama' => 'required|string|min:1',
            'email' => 'required|email|max:255|unique:users',
            'peranan' => 'required|string',
        ]);

        return $pc->store_panel_penilai($request);
        
    }

}
