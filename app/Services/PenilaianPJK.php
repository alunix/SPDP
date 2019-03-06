<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use SPDP\Services\PenilaianClass;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\StatusPermohonanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianPJK
{
    

    
    public function createPerakuanPjk(Request $request,$permohonan)
    {   
    $penilaian = new PenilaianClass();
    $penilaian = $penilaian->create($request,$permohonan);
    $attached = 'perakuan_pjk';
    $laporan = new LaporanClass();
    $laporan->createLaporan($request,$penilaian,$attached);

    
    $permohonan=Permohonan::find($permohonan->id);
    $sp = new StatusPermohonanClass();
    $permohonan->status_permohonan_id=$sp->getStatusPermohonan($permohonan);
    $permohonan->save();

    $kj = new KemajuanPermohonanClass();
    $kj->create($permohonan);

    $msg = [
        'message' => 'Laporan berjaya dimuat naik',
       ];
    return redirect('/home')->with($msg);



    }

    public function pelantikanPenilaiSubmit(Request $request, $id)
    {
         /* Find permohonan id then change the status permohonan */
         $permohonan =Permohonan::find($id);   
         $sp = new StatusPermohonanClass();            
         $permohonan -> status_permohonan_id = $sp->getStatusPermohonan($permohonan);
         $permohonan -> save();

          //Create a new kemajuan permohonan for each progress
          $kp = new KemajuanPermohonanClass();
          $kp->create($permohonan);
         

         //Create a new penilaian in penilaian table
       
         $selectedPenilai = $request->input('checked');
        

        $penilaian = new PenilaianClass();
        $penilaian =  $penilaian->create($permohonan);
        $penilaian -> dokumen_id = $permohonan->id;
        $penilaian -> penilaian_panel_1= $selectedPenilai[0];
        $penilaian -> save();
   
         
         return redirect(url('/senarai-penilaian'));
    }

    public function showPerakuanPjk($id)
    {   
        $permohonan = Permohonan::find($id);
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
 
        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program':
                    return $this->viewProgramBaharu($id);
            break;
            case 'kursus_teras_baharu':
            case 'kursus_elektif_baharu':
            return $this->viewKursusTerasElektifBaharu($id);
            break;
            case 'semakan_kursus_teras':
            return view('jenis_permohonan_view.kursus-wajib-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
                break; 
            case 'semakan_kursus_elektif':
            return view('jenis_permohonan_view.semakan-kursus-elektif')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
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
       $id= $permohonan->id;
       $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
       
        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program':
            return $this->updateLaporanPanel($request,$id);
            break;
            case 'kursus_teras_baharu':
            case 'kursus_elektif_baharu':
            return $this->createPerakuanPjk($request,$permohonan);
            break;
            case 'semakan_kursus_teras':
            return view('jenis_permohonan_view.kursus-wajib-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
                break; 
            case 'semakan_kursus_elektif':
            return view('jenis_permohonan_view.semakan-kursus-elektif')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
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

    public function viewProgramBaharu($id)
    {
        $penilaian=Penilaian::find($id);
       $laporan=Laporan::where('penilaian_id_laporan',$penilaian->id)->get();
    
       $laporan= $penilaian->laporan;

       
        
        return view('pjk.lampiran-pjk')->with('permohonan',$penilaian->permohonan)->with('penilaian',$penilaian)->with('laporan',$laporan);

        
    }

    public function viewKursusTerasElektifBaharu($id)
    {
         $permohonan = Permohonan::find($id);
        return view ('pjk.perakuan-pjk')->with('permohonan',$permohonan);

        
    }
    
    public function updateLaporanPanel(Request $request, $id){
      
           
            /* Cari permohonan since penilaian belongs to permohonan then baru boleh cari penilaian through eloquent relationship */
            $penilaian= Penilaian::find($id);
            $permohonan = $penilaian->permohonan;
            //Upload perakuan
            $attached = 'perakuan_pjk';
            $laporan = new LaporanClass();
            $laporan_id= $penilaian->laporan->laporan_id;
            $laporan->uploadLaporan( $request,$penilaian,$attached,$laporan_id);

            /* Status semakan permohonan telah dikemaskini berdasarkan progress */
            $permohonan -> status_permohonan_id = 4;
            $permohonan ->save();

            $kj= new KemajuanPermohonanClass();
            $kj->create($permohonan);

            $msg = [
                'message' => 'Perakuan berjaya dimuatnaik',
               ];  
            
            return redirect('/')->with($msg);

    }

   

    

    public function store_panel_penilai(Request $request)
    {
        $user= new User();
        $user->name = $request -> input('name');
        $user->email = $request -> input('email');
        $user->role = 'penilai';
        $user->password= Hash::make('abcd123');
        $user->save();

        return redirect()->route('register.panel_penilai.show');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \SPDP\A  $a
     * @return \Illuminate\Http\Response
     */
    public function destroy(A $a)
    {
        //
    }
}
