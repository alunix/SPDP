<?php

namespace SPDP\Http\Controllers;

use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\User;
use SPDP\Penilaian;
use SPDP\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SPDP\Services\PermohonanClass;
use SPDP\Services\RedirectPermohonan;
use SPDP\Services\PenilaianPJK;
use SPDP\Services\SenaraiPermohonan;

class LaporanController extends Controller
{
  
    public function index() {
        $laporan = Laporan::all();
    }
   
    public function show($id) {
        $dp = DokumenPermohonan::find($id);
        if($dp==null) {
            abort (404);
        }
        $isFakulti = $this->isFakulti();
        if($isFakulti==1){
            return $this->fakulti($dp);
        }
        else {
            return view ('fakulti.senarai-laporan-dokumen-permohonan')->with('dokumen_permohonan',$dp)->with('laporans',$dp->laporans);
        }
    }

    public function fakulti($dp) {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id= $user->permohonans->pluck('permohonan_id');
        $dokumen_permohonans_id= DokumenPermohonan::whereIn('permohonan_id',$permohonans_id)->pluck('dokumen_permohonan_id');

        //check whether fakulti does have permohonans
        if(count($permohonans_id)==0||count($dokumen_permohonans_id)==0) {
            abort(404);
        }

        for($i=0;$i<count($dokumen_permohonans_id);$i++) {
            if($dp->dokumen_permohonan_id == $dokumen_permohonans_id[$i]) {
                return view ('fakulti.senarai-laporan-dokumen-permohonan')->with('dokumen_permohonan',$dp)->with('laporans',$dp->laporans);
            }
        } 
        abort(404);
    }

 public function isFakulti() {
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
