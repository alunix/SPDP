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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect(Permohonan $permohonan)
    {
        $jp =$permohonan->jenis_permohonan->jenis_permohonan_kod;
       
        
        switch ($jp) {
            case 'program_baharu':
                    return view('jenis_permohonan_view.program-pengajian-baharu')->with('permohonan',$permohonan)->with('jenis_permohonan',$permohonan->jenis_permohonan);
            break; 
            case 'kursus_teras_baharu':
            return view('jenis_permohonan_view.kursus-wajib-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
            break; 
            case 'kursus_elektif_baharu':
            return view('jenis_permohonan_view.kursus-elektif-baharu')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
            break; 
            case 'semakan_kursus_teras':
            case 'semakan_program':
            case 'semakan_kursus_elektif':
            return view('jenis_permohonan_view.semakan-kursus-teras')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
                break;
            case 'penjumudan_program':
            return view('jenis_permohonan_view.penjumudan-program')->with('permohonan',$permohonan)->with('penilaian',$permohonan->penilaian);
                break; 
            default:
                    return;
        }
    }

    
}
