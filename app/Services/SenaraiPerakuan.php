<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\Penilaian;



class SenaraiPerakuan
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function senaraiPerakuan()
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
        return view ('pjk.senarai-perakuan-permohonan')->with('permohonans',$permohonans);
       
    }

    public function pjk(){
        $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=',3)->orWhere('status_permohonan_id','=',13)->get();
        
        return $permohonans;
    }
    
   
    public function penilai(){

        $user_id = auth()->user()->id;
       
        $penilaians= Penilaian::where('penilaian_panel_1',$user_id)->get();

        if (empty((array) $penilaians)) { //check if array object is empty
            $permohonans= new Permohonan();
        }

        else{
            $permohonans_id= $penilaians->pluck('permohonan_id_penilaian');
            $permohonans= Permohonan::whereIn('permohonan_id',$permohonans_id)->where('status_permohonan_id','=','2')->orWhere('status_permohonan_id','=','12')->get();
        }

        return $permohonans;
                
        }
    public function jppa(){
        $permohonans= Permohonan::where('status_permohonan_id','=','4')->orWhere('status_permohonan_id','=','14')->get();
    
        return $permohonans;
    }
    public function senat(){        
        $permohonans = Permohonan::where('status_permohonan_id','=','5')->orWhere('status_permohonan_id','=','15')->get();
        
        return $permohonans;
    }
    

   
}
