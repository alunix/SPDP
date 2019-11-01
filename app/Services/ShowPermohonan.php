<?php 

namespace SPDP\Services;
use SPDP\User;
use SPDP\Services\RedirectPermohonan;
use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Support\Collection;

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
        $dp =  $this->getBoolPermohonan($permohonan);
        if ($dp == false) {
            abort(403, 'Tidak dibenarkan');
        } else {
            $permohonan = Permohonan::where('permohonan_id', $permohonan->permohonan_id )
            ->with(['dokumen_permohonans.laporans.id_penghantar_nama', 'laporans.id_penghantar_nama', 'kemajuan_permohonans.statusPermohonan' ])->get();

            // $kemajuan = (new Collection($permohonan[0]->kemajuan_permohonans))->paginate(3 ,['*'], 'kemajuan');
            $kemajuan = ($permohonan[0]->kemajuan_permohonans->paginate(3,['*'], 'kemajuan' ));
            // $dokumens =  (new Collection($permohonan[0]->dokumen_permohonans))->paginate(3);
            $laporans = (new Collection($permohonan[0]->laporans))->paginate(3);
            return response()->json(['kemajuans' => $kemajuan , 'dokumens' => $dokumens, 'laporans' => $laporans , 'permohonan' => $permohonan[0]]);
            // return response()->json(['laporans' => $permohonan[0]->laporans, 'kemajuans' => $permohonan[0]->kemajuan_permohonans, 'permohonan' => $permohonan[0], 'dokumens' => $permohonan[0]->dokumen_permohonans]);
        }
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
        if($permohonan == null) {
            return false;
        }
        
        $isFakulti = $this->isFakulti();
        if($isFakulti == false) {
            return true;
        }
        else { 
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id= $user->permohonans->pluck('permohonan_id');
        
        //check whether fakulti does have permohonans
        if(!sizeof($permohonans_id) > 0 ) {
            return false;
            die();
        }
        for($i = 0; $i<count($permohonans_id); $i++) { 
            if($permohonan->permohonan_id == $permohonans_id[$i]) {
                return true;
            }
        } 
           return false;
        }

    }

    public function isFakulti(){
        $role = auth()->user()->role;

        if (!$role == 'fakulti') {
            return 0;
        }
        else {
            return 1;
        }
    }

   

   
        
    
   
    

   
}
