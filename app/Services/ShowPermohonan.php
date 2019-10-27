<?php 

namespace SPDP\Services;
use SPDP\User;
use SPDP\Services\RedirectPermohonan;
use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\SenaraiPermohonan;

class ShowPermohonan
{
    public function show($permohonan) { 
        $role = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                return $this->fakulti($permohonan);
                break;
            case 'penilai':
                return $this->penilai($permohonan);
                break;
            default:
                $rp = new RedirectPermohonan();
                return $rp->redirect($permohonan);
                break;
        }
    }

    public function fakulti($permohonan) {
        //Redirect ke page kemajuan permohonan
        $kp = new KemajuanPermohonanClass();
        return $kp->show($permohonan);
    }

    public function penilai($permohonan) {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $permohonans = new SenaraiPermohonan();
        $permohonans = $permohonans->penilai();

        if ($permohonans == null) {
            abort(404);
        }
        $permohonans_id = $permohonans->pluck('permohonan_id');
        for($i=0;$i<count($permohonans_id);$i++){ 
            if($permohonan->permohonan_id == $permohonans_id[$i]) {
                $rp = new RedirectPermohonan();
                return $rp->redirectPermohonan($permohonan);
            }
       }
       abort(404);
    }


    public function getBoolPermohonan($permohonan) {
        if($permohonan==null) {
            return 0;
        }
        
        $isFakulti = $this->isFakulti();
        if($isFakulti==0){
            return 1;
        }
        else { 
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id= $user->permohonans->pluck('permohonan_id');
        
        //check whether fakulti does have permohonans
        if(count($permohonans_id) == 0 ) {
            return 0;
            die();
        }
        for($i = 0; $i<count($permohonans_id); $i++) { 
            if($permohonan->permohonan_id == $permohonans_id[$i]) {
                return 1;
            }
        } 
           return 0;
        }

    }

    public function isFakulti(){
        $role = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                return 1;
            break;
            default:
                return 0;
                break;
        }

    }

   

   
        
    
   
    

   
}
