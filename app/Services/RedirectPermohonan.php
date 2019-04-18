<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\MuatNaikLaporan;


class RedirectPermohonan
{
 
    public function redirect($permohonan)
    
    {   
        if($permohonan==null){
            abort(404);
        }
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;  
        
        $dp = $permohonan->dokumen_permohonans->pluck('dokumen_permohonan_id');
        $laporans= Laporan::whereIn('dokumen_permohonan_id',$dp)->get();
        
        switch ($jp) {
            case 'program_baharu':
            return $this->program_baharu($permohonan,$laporans);   
            break; 

            case 'kursus_teras_baharu':
            return $this->kursus_teras_baharu($permohonan,$laporans);   
            break; 

            case 'kursus_elektif_baharu':
                return $this->kursus_elektif_baharu($permohonan,$laporans);
            break;

            case 'semakan_kursus_teras':
            case 'semakan_program':
            case 'semakan_kursus_elektif':
            return $this->semakan_kursus_program($permohonan,$laporans);
            break;

            case 'penjumudan_program':
            return $this->penjumudan_program($permohonan,$laporans);
            break;

            default:
                    return;
        }
    }

    public function program_baharu($permohonan,$laporans){
    return view('jenis_permohonan_view.program-pengajian-baharu')->with('permohonan',$permohonan)->with('laporans',$laporans);

    }
    public function kursus_teras_baharu($permohonan,$laporans){
        return view('jenis_permohonan_view.kursus-wajib-baharu')->with('permohonan',$permohonan)->with('laporans',$laporans);
    }
    public function kursus_elektif_baharu($permohonan,$laporans){
        return view('jenis_permohonan_view.kursus-elektif-baharu')->with('permohonan',$permohonan)->with('laporans',$laporans);
    }
    public function semakan_kursus_program($permohonan,$laporans){
        return view('jenis_permohonan_view.semakan-kursus-teras')->with('permohonan',$permohonan)->with('laporans',$laporans);
    }
    public function penjumudan_program($permohonan,$laporans){
        return view('jenis_permohonan_view.penjumudan-program')->with('permohonan',$permohonan)->with('laporans',$laporans);
    }
    
    }


    



