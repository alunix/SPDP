<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PenilaianClass 
{
    
    public function create($permohonan)
    {   
        
        $role =auth()->user()->role;
        $user_id = auth()->user()->id;
        $penilaian = new Penilaian();
        $penilaian->dokumen_id= $permohonan->id;

        switch ($role) {
            case 'pjk':
            $penilaian->penilaian_pjk= $user_id;
            break;
            case 'jppa':
            $penilaian->penilaian_jppa=$user_id;
                break; 
            default:
                    return null;
                break;
        }
        $penilaian->status_penilaian=1;
        $penilaian->save();

        return $penilaian;
    }   


    public function store_panel_penilai(Request $request)
    {
        $user= new User();
        $user->name = $request -> input('name');
        $user->email = $request -> input('email');
        $user->role = 'penilai';
        $user->password= Hash::make('abcd123');
        $user->save();

        return redirect()->route('register.panel_penilai.show');
    }


}
