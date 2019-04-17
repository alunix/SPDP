<?php

namespace SPDP\Services;


use SPDP\User;
use SPDP\Services\RedirectPermohonan;


class ShowPermohonan
{
   public function show($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $permohonans_id= $user->permohonans->pluck('permohonan_id');
        
        $role = auth()->user()->role;
        
        switch ($role) {
            case 'fakulti':
            return $this->fakulti($permohonans_id,$permohonan);
            
            break;
           
            default:
            $rp = new RedirectPermohonan();
            return $rp->redirect($permohonan);
                break;
        }

    }

    public function fakulti($permohonans_id,$permohonan){

        $permohonan= Permohonan::find($permohonan->permohonan_id);


        if($permohonan==null){
           abort(403,'Tidak dibenarkan');
        }

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
