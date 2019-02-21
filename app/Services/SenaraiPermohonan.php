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
            default:
                    return null;
                break;
        }

        
        return view ('fakulti.senarai-permohonan-dihantar')->with('permohonans',$permohonans);

        
       
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
        return view('dashboard/penilai-dashboard');
                
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
