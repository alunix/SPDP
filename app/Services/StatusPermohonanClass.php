<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\User;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\MuatNaikLaporan;


class StatusPermohonanClass
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatusPermohonan($permohonan)
    {
        
        $role = auth()->user()->role;
        

        switch ($role) {
            
            case 'pjk':
            return $this->pjk($permohonan);
                break; 
            case 'senat':
            return $this->senat();
            break; 
            case 'penilai':
            return $this->penilai();
                break; 
            case 'jppa':
            return $this->jppa();
                break; 
            default:
                    return view ('/login'); 
                break;
        }
        

        
       
    }

    public function pjk($permohonan){

        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
        $penilaian_id=Penilaian::where('dokumen_id',$jp->id);
        $laporan=Laporan::where('penilaian_id_laporan',$penilaian_id)->get();
        

        

        
        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program': //same condition yang akan lalui panel penilai
            if($laporan->laporan_panel_penilai_link->isEmpty() ){

                return '2';
            }
            else{

                return '4';
            }
            break;
           
            case 'kursus_teras_baharu':
            return '4';
            break; 
            case 'kursus_elektif_baharu':
                return '7';
            break; 
            case 'semakan_kursus_teras'://will figure out the rest 3/3/2019
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
    public function penilai(Request $req){
        return view('dashboard/penilai-dashboard');
                
        }
    public function jppa(Request $req){
        return view('dashboard/jppa-dashboard');
                
        }
    public function senat(Request $req){
        return view('dashboard/senat-dashboard');
                
        }
    

   
}
