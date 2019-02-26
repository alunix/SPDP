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


class SenaraiPermohonan
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $role = auth()->user()->role;
        

        switch ($role) {
            case 'pjk':
            $permohonans= $this->pjk();
            case 'jppa':
            $permohonans= $this->jppa();
                break; 
            case 'penilai':
            $permohonans= $this->penilai();
                break; 
            case 'senat':
            $permohonans= $this->senat();
                break;
            default:
                    return null;
                break;
        }

        
        return view ('pjk.pjk-view-permohonan-baharu.blade')->with('permohonans',$permohonans);

        
       
    }

    public function fakulti(){

        // $fakulti = auth()->user()->fakulti;


        // $permohonans = Permohonan::where('user->fakulti', $fakulti)->get();

        // return $permohonans;

        
        $user_id =auth()->user()->id;
        $user= User::find($user_id);
        
        
        }


    public function pjk(){

     $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=','1')->get();

     return $permohonans;
        
            
        }
    public function penilai(Request $req){
        $permohonans = Permohonan::where('status_permohonan_id','=','2')->get();

        return $permohonans;
                
        }
    public function jppa(Request $req){
        $permohonans = Permohonan::whereHas('jenis_permohonan_id','=','8')->where('status_permohonan_id','=','Belum disemak')->get();
        return $permohonans;
                
        }
    public function senat(Request $req){        
        $permohonans = Permohonan::where('status_permohonan_id','=','5')->get();
        return $permohonans;
                
        }
    

   
}
