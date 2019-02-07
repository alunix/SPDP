<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class GetPenilaians
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPenilaians()
    {
        $role =auth()->user()->role;

        switch ($role) {
            case 'pjk':
            $penilaians = Penilaian::all();
           
               break; 
            case 'senat':
            $penilaians = Penilaian::whereHas('permohonan', function($query){
                $query->where('status_permohonan','=', 'Perakuan JPPA telah dilampirkan, permohonan akan dihantar kepada pihak Senat');           
      
        })->get();
               break; 
            case 'penilai':
            $penilaian= Penilaian::all();
            $penilaians= $penilaians->permohonan->where('status_permohonan','=','Diluluskan oleh PJK(Permohonan akan dinilai oleh panel penilai');
           
       
                break; 
            case 'jppa':
            $laporan->perakuan_jppa= $filename;
            $laporan->perakuan_jppa_link= $fileNameToStore;
                break; 
            default:
                    return 'public/pdf_error';
                break;
        }

        return $penilaians;

       



    }

    

  
    public function edit(A $a)
    {
        //
    }

   
    public function destroy(A $a)
    {
        //
    }
}
