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
    public function showPermohonanPenilai()
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
    public function update(PenilaianClass $pcm,Request $request,$id)
    {
        $this->validate($request,[
            'laporan_panel_penilai' => 'required|file|max:1999',
        ]);

        return $pc->update($request,$id);
       
    }

    public function updateLaporanPanel(PenilaianClass $pc,Request $request, $id){

        $this->validate($request,[
            'perakuan_pjk' => 'required|file|max:1999',
        ]);
        
        return $pc->updateLaporanPanel($request,$id);

    }

    public function updatePerakuanPJK(PenilaianClass $pc,Request $request, $id){

        $this->validate($request,[
            'perakuan_jppa' => 'required|file|max:1999',
        ]);
        
        return $pc->updatePerakuanPJK($request,$id);

    }

    public function updatePerakuanJPPA(PenilaianClass $pc,Request $request, $id){

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
