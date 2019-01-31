<?php

namespace SPDP\Http\Controllers;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SPDP\Services\PermohonanClass;

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

       public function showListPermohonanBaharu(Request $request)
     {

    
        $permohonans = Permohonan::where('status_permohonan','Belum disemak')->get();
        return view ('pjk.pjk-view-permohonan-baharu')->with('permohonans',$permohonans);

     

     }

     public function showListPanelPenilai(Request $request,$id)
     {
        
        
     
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
        // $role=auth()->user()->role;

        // if($role=="pjk")
        //     return view('posts/view-permohonan-baharu')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);
        // else
        //    return view('posts/view-permohonan-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);

        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;

        switch ($jp) {
            case 'program_baharu':
                    return view('dashboard/fakulti-dashboard');
                break;
            case 'semakan_program':
                    return view('dashboard/pjk-dashboard');
                break; 
            case 'kursus_baru':
                return view('dashboard/senat-dashboard');
            break; 
            case 'semakan_kursus':
                    return view('dashboard/penilai-dashboard');
                break; 
            case 'akreditasi_penuh':
                    return view('dashboard/jppa-dashboard');
                break; 
            case 'penjumudan_program':
                return view('dashboard/jppa-dashboard');
            break; 
            default:
                    return view ('/login'); 
                break;
        }



        
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
    public function update(PermohonanClass $pc,Request $request, $id)    {      
        
        $this->validate($request,[

            'checked' => 'required',

        ]);
            return $pc->update($request,$id);
           
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
