<?php

namespace SPDP\Services;


use SPDP\User;
use SPDP\Services\RedirectPermohonan;
use SPDP\Permohonan;
use SPDP\Penilaian;


class ShowPermohonan
{
   public function show($permohonan)
    { 
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

    public function fakulti($permohonan){
        
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $permohonans_id= $user->permohonans->pluck('permohonan_id');
        
       

        if(count($permohonans_id)==0) //check whether fakulti does have permohonans
        { 
            abort(403, 'Tidak dibenarkan');
        }

        for($i=0;$i<count($permohonans_id);$i++){ // fixed bug where the loop was i<count instead of i<=count // basic first year error
            
            if($permohonan->permohonan_id == $permohonans_id[$i]) {
                            $rp = new RedirectPermohonan();
                            return $rp->redirect($permohonan);}
                } 
                abort(403, 'Tidak dibenarkan');
    }

    public function penilai($permohonan){
        
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if($permohonan==null){
            abort(403,'Tidak dibenarkan');
         }
        
        $penilaian= $permohonan->penilaian;

        if ($penilaian==null){
            abort(404);
        }

        $panel_id= $penilaian->penilaian_panel_1;

        if($panel_id==$user_id){
            $rp = new RedirectPermohonan();
            return $rp->redirect($permohonan);
        }
        else{
            abort(404);
        }

        
    }


    public function getBoolPermohonan($permohonan){

        if($permohonan==null){
            return 0;
         }
        
        $isFakulti = $this->isFakulti();

        if($isFakulti==0){
            return 1;
        }

        else{

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id= $user->permohonans->pluck('permohonan_id');

        if(count($permohonans_id)==0) //check whether fakulti does have permohonans
        {
            return 0;
            die();
        }

        for($i=0;$i<count($permohonans_id);$i++){ // fixed bug where the loop was i<count instead of i<=count // basic first year error
           
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
