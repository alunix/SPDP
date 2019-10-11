<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\PenilaianPanel;
use Illuminate\Support\Facades\DB;

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
        return response()->json($permohonans);
       
    }

    public function pjk(){
     $permohonans = Permohonan::with(['user.fakulti', 'jenis_permohonan', 'dokumen_permohonans' ,'fakulti'])->where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=','1')->get();
     return $permohonans;
    }
    
    public function perakuanPjk(){

            $permohonans = Permohonan::where('jenis_permohonan_id','!=','8')->where('status_permohonan_id','=',3)->get();
            return view ('pjk.senarai-perakuan-penilaian')->with('permohonans',$permohonans);
    }
    
    public function penilai(){

        $user_id = auth()->user()->id;
       
        $permohonans=  DB::table("permohonans") 
        ->join('penilaian_panels','penilaian_panels.permohonanID','=','permohonans.permohonan_id')
        ->join('users','users.id','=','penilaian_panels.id_penilai')
        ->where('permohonans.status_permohonan_id',2)
        ->where('penilaian_panels.id_penilai',$user_id)       
        ->get();
        
         if (empty((array) $permohonans)) { //check if array object is empty
            $permohonans= new Permohonan();
        }

        else{
            $id = $permohonans->pluck('permohonan_id');
            $permohonans = Permohonan::whereIn('permohonan_id',$id)->get();
        }

        return $permohonans;
                
        }
    public function jppa(){

        $permohonans = Permohonan::where('jenis_permohonan_id',8)->where('status_permohonan_id',1)->orWhere('status_permohonan_id',4)->get();

        return $permohonans;
      
        }
    public function senat(){        
        $permohonans = Permohonan::where('status_permohonan_id','=','5')->get();
        return $permohonans;
                
        }
    

   
}
