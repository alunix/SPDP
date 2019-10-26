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

class StatusPermohonanClass
{
   public function getStatusPermohonan($permohonan) {
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
                return $this->pjk($permohonan);
                break; 
            case 'senat':
                return $this->senat();
                break; 
            case 'penilai':
                return $this->penilai($permohonan);
                break; 
            case 'jppa':
                return $this->jppa();
                break; 
            default:
                return view ('/login'); 
                break;
        }
    }

    public function pjk($permohonan) {
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
        switch ($jp) {
            case 'program_baharu':
            case 'semakan_program': //same condition yang akan lalui panel penilai
            if($permohonan->status_permohonan_id==1)
                return '2'; //if no laporan are found that means permohonan masih disemak oleh panel penilai
            else
                return '4';
                break;
            case 'kursus_teras_baharu':
                return '4';
                break; 
            case 'kursus_elektif_baharu':
                return '7';
                break; 
            case 'semakan_kursus_teras'://will figure out the rest 3/3/2019
                return 4;
                break; 
            case 'semakan_kursus_elektif':
                return 7;
                break;
            default:
                return view ('/home'); 
                break;
        }
    }
    
   
    

   
}
