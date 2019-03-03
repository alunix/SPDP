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


class StatusPermohonan
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatusPermohonan()
    {
        
        $role = auth()->user()->role;
        

        switch ($role) {
           case 'pjk':
            return $this->pjk();
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

    public function fakulti(){

        $user_id =auth()->user()->id;
        $user= User::find($user_id);
        return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$user->permohonans);



      
        
        }
    public function pjk(Request $req){
        return view('dashboard/pjk-dashboard');
            
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
