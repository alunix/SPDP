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
            break;
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

        
        return view ('pjk.pjk-view-permohonan-baharu')->with('permohonans',$permohonans);

        
       
    }

    public function pjk(){

     $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=','1')->get();

     
     return $permohonans;
        
            
        }
    
    public function perakuanPjk(){

            $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=',3)->get();
       
            return view ('pjk.senarai-perakuan-penilaian')->with('permohonans',$permohonans);
               
                   
               }
    
    public function penilai(){

        $user_id = auth()->user()->id;
       
        $penilaians= Penilaian::where('penilaian_panel_1',$user_id)->get();

        if (empty((array) $penilaians)) { //check if array object is empty
            $permohonans= new Permohonan();
        }

        else{
            $permohonans_id= $penilaians->pluck('permohonan_id_penilaian');
            $permohonans= Permohonan::whereIn('permohonan_id',$permohonans_id)->where('status_permohonan_id','=','2')->get();
        }

        return $permohonans;
                
        }
    public function jppa(){

        $user_id = auth()->user()->id;
        $penilaians= Penilaian::where('penilaian_panel_1',$user_id)->get();

        if (empty((array) $penilaians)) { //check if array object is empty
            $permohonans= new Permohonan();
        }

        else{
            $permohonans_id= $penilaians->pluck('permohonan_id_penilaian');
            $permohonans= Permohonan::whereIn('permohonan_id',$permohonans_id)->where('jenis_permohonan_id','=','8')->where('status_permohonan_id','=','1')->orWhere('status_permohonan_id','=','4')->get();
            // $permohonans = Permohonan::where('jenis_permohonan_id','=','8')->where('status_permohonan_id','=','1')->orWhere('status_permohonan_id','=','4')->get();

        }

       
        return $permohonans;
                
        }
    public function senat(){        
        $permohonans = Permohonan::where('status_permohonan_id','=','5')->get();
        return $permohonans;
                
        }
    

   
}
