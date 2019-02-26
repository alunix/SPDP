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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
   

    // public function uploadPerakuanJppa($id){

    //     $pp = new PenilaianPJK();

    //     $penilaian=Penilaian::find($id);
    //     $penilaian_id=$penilaian->id;
    //     $penilaian=Penilaian::find($penilaian_id);
        
    //     return view('jppa.lampiran-perakuan-jppa')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian);
    //  }

     public function showPerakuanJPPA($id){

        $penilaian=Penilaian::find($id);        
        $penilaian_id=$penilaian->id;
        $penilaian=Penilaian::find($penilaian_id);
        return view('jppa.lampiran-perakuan-jppa')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian);
     }

     public function uploadPerakuanJppa(PenilaianClass $pc,Request $request, $id){

        $this->validate($request,[
            'perakuan_jppa' => 'required|file|max:1999',
        ]);
        
        return $pc->updatePerakuanPJK($request,$id);

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

        return $pp->uploadLaporanPenilai($request,$id);
       
    }  

    

    public function uploadPerakuanSenat(PenilaianClass $pc,Request $request, $id){

        $this->validate($request,[
            'perakuan_senat' => 'required|file|max:1999',
        ]);

        return $pc->updatePerakuanJPPA($request,$id);

       
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
