<?php

namespace SPDP\Services;


use SPDP\Permohonan;
use SPDP\User;
use SPDP\Services\LaporanClass;
use SPDP\Services\PenilaianClass;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\StatusPermohonanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Notification;
use SPDP\Laporan;
use SPDP\Notifications\PermohonanBaharu;
use SPDP\Notifications\PermohonanDiluluskan;


class PenilaianPJK
{
    public function createPerakuanPjk(Request $request,$permohonan)
    {   
    $penilaian = new PenilaianClass();
    $penilaian = $penilaian->create($permohonan);
    $attached = 'perakuan_pjk';
    $laporan = new LaporanClass();
    $laporan->createLaporan($request,$penilaian,$attached);

    
    $permohonan=Permohonan::find($permohonan->id);
    $sp = new StatusPermohonanClass();
    $permohonan->status_permohonan_id=$sp->getStatusPermohonan($permohonan);
    $permohonan->save();

    //Hantar email kepada penghantar
    $penghantar = User::find($permohonan->id_penghantar);
    Notification::route('mail',$penghantar->email)->notify(new PermohonanDiluluskan($permohonan,$penghantar)); //hantar email kepada penghantar

    $kj = new KemajuanPermohonanClass();
    $kj->create($permohonan);

    $msg = [
        'message' => 'Laporan berjaya dimuat naik',
       ];
    return redirect()->route('home')->with($msg);
    }

    public function pelantikanPenilaiSubmit(Request $request, $id)
    {      
        try {
        /* Find permohonan id then change the status permohonan */
        $permohonan =Permohonan::find($id);   
        $permohonan -> status_permohonan_id = 2;
        $permohonan -> save();

        //Create a new kemajuan permohonan for each progress
        $kp = new KemajuanPermohonanClass();
        $kp->create($permohonan);

        //Create a new penilaian in penilaian table
        $selectedPenilai = $request->input('checked'); //retrieve id of panel penilai
        $user= User::find($selectedPenilai[0]); 
        Notification::route('mail',$user->email)->notify(new PermohonanBaharu($permohonan,$user)); //hantar email kepada panel penilai

        $penilaian = new PenilaianClass();
        $penilaian =  $penilaian->create($permohonan);
        $penilaian -> penilaian_panel_1= $selectedPenilai[0];
        $penilaian -> save();

        $msg = [
            'message' => 'Panel penilai dipilih dan emel telah dihantar',
           ];
         
        return redirect()->route('penilaian.show')->with($msg);

          } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return 'Duplicate Entry for';
            }
          }

    }

    public function showPerakuanPjk($id)
    {   
        $permohonan = Permohonan::find($id);
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
        $status_permohonan = $permohonan->value('status_permohonan_id');

 
        switch ($jp) {
            case 'program_baharu':
                    return $this->viewProgramBaharu($id);
            break;
            
            case 'kursus_teras_baharu':
            case 'kursus_elektif_baharu':
            return $this->viewKursusTerasElektifBaharu($id);
                break;

            case 'semakan_kursus_teras':
            case 'semakan_kursus_elektif':
            case 'semakan_program':            
            if($status_permohonan == '1'  ) // if permohonan require minority changes then create a new perakuan
            return $this->viewKursusTerasElektifBaharu($id);
                else if ($status_permohonan == '3'  )
                    return  $this->viewProgramBaharu($id);
                else 
            return;
                break;

            case 'akreditasi_penuh':
            return view('jenis_permohonan_view.program_pengajian_baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
                break;

            case 'penjumudan_program':
            return view('jenis_permohonan_view.penjumudan_program')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
            break;

            default:
                    return view ('/home'); 
                break;
        }
        
    }

    
    public function uploadPerakuanPjk($request,$permohonan)
    {   
      $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
       
    switch ($jp) {

        case 'program_baharu':
        case 'semakan_program':
        return $this->updateLaporanPanel($request,$permohonan);
        break;

        case 'kursus_teras_baharu':
        case 'kursus_elektif_baharu':
        return $this->createPerakuanPjk($request,$permohonan);
        break;

        case 'semakan_kursus_teras':
        return $this->semakanKursusTeras($request,$permohonan);           
        break; 

        case 'semakan_kursus_elektif':
        return $this->semakanKursusElektif($request,$permohonan);
            break; 

        case 'akreditasi_penuh':
        return view('jenis_permohonan_view.program_pengajian_baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
            break;

        case 'penjumudan_program':
        return view('jenis_permohonan_view.penjumudan_program')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
        break; 
        default:
                return; 
            break;
        }
    }

    public function viewProgramBaharu($id)
    {
        $permohonan=Permohonan::find($id);

        if($permohonan==null)
            abort(403);

        $penilaian= $permohonan->penilaian;

        if($penilaian==null)
            abort(403);

        $dp = $permohonan->dokumen_permohonans->pluck('dokumen_permohonan_id');
        $laporans= Laporan::whereIn('dokumen_permohonan_id',$dp)->get();
        return view('pjk.lampiran-pjk')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian)->with('laporans',$laporans);
    }

    public function viewKursusTerasElektifBaharu($id)
    {
        $permohonan = Permohonan::find($id);

        if($permohonan==null)
        abort(403);

        $dp = $permohonan->dokumen_permohonans->pluck('dokumen_permohonan_id');
        $laporans= Laporan::whereIn('dokumen_permohonan_id',$dp)->get();
        return view ('pjk.perakuan-pjk')->with('permohonan',$permohonan)->with('laporans',$laporans);;
    }
    
    public function updateLaporanPanel(Request $request, $permohonan){
           
        /*Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
        $penilaian= $permohonan->penilaian;
        
        //Upload perakuan
        $attached = 'perakuan_pjk';
        $laporan = new LaporanClass();
        $laporan->createLaporan($request,$permohonan,$attached);

        /*Status semakan permohonan telah dikemaskini berdasarkan progress */
        $sp = new StatusPermohonanClass();
        $permohonan->status_permohonan_id=$sp->getStatusPermohonan($permohonan);
        $permohonan ->save();

        //Hantar email kepada penghantar
        $penghantar = User::find($permohonan->id_penghantar);
        Notification::route('mail',$penghantar->email)->notify(new PermohonanDiluluskan($permohonan,$penghantar)); 

        //Kemajuan permohonan baharu
        $kj= new KemajuanPermohonanClass();
        $kj->create($permohonan);

        $msg = [
            'message' => 'Perakuan berjaya dimuatnaik',
            ];  
        
        return redirect()->route('home')->with($msg);

    }

    public function semakanKursusTeras(Request $request, $permohonan){

        $status_permohonan = $permohonan->status_permohonan_id;
        if($status_permohonan == '1'  ) // if permohonan require minority changes then create a new perakuan
           return $this->createPerakuanPjk($request,$permohonan);
        else if ($status_permohonan == '3'  )
            return $this->updateLaporanPanel($request,$permohonan);
        else 
            return;
}    

public function semakanKursusElektif(Request $request, $permohonan){
           
    /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
    $status_permohonan = $permohonan->status_permohonan_id;
    
    if($status_permohonan == '1'  ) // if permohonan require minority changes then create a new perakuan
        return $this->createPerakuanPjk($request,$permohonan);
    else if ($status_permohonan == '3'  )
        return $this->updateLaporanPanel($request,$permohonan);
    else 
        return;
}    

    public function store_panel_penilai(Request $request)
    {
        $user= new User();
        $user->name = $request -> input('name');
        $user->email = $request -> input('email');
        $user->role = 'penilai';
        $user->password= Hash::make('abcd123');
        $user->save();

        $msg = [
        'message' => 'Pengguna berjaya didaftarkan',
       ];

        return redirect()->route('register.panel_penilai.show')->with($msg);
    }


   
}
