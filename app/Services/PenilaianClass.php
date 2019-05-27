<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SPDP\Notifications\PendaftaranPengguna;
use Notification;

class PenilaianClass 
{
    
    public function create($permohonan)
    {   
        
        $role =auth()->user()->role;
        $user_id = auth()->user()->id;
        $penilaian = new Penilaian();
        $penilaian->permohonan_id_penilaian= $permohonan->permohonan_id;

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
        
        $random = str_random(8);
        $radio= $request->input('radios');

            switch ($radio) {
                case 'autoGenerate':
                    $password = $random;
                     break;
                case 'manualGenerate':
                    $password = $request -> input('password');
                     break;
            }
       
        $user= new User();
        $user->name = $request -> input('nama');
        $user->email = $request -> input('email');
        $user->role = $request -> input('peranan');
        $user->password= Hash::make($password);
        $user->save();

        $msg = [
            'message' => 'Pengguna berjaya didaftar dan emel telah dihantar kepada pengguna',
           ];     

        Notification::route('mail',$user->email)->notify(new PendaftaranPengguna($user,$password)); //hantar email kepada penghantar

        return redirect()->route('register.panel_penilai.show')->with($msg);
    }


}
