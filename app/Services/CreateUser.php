<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use Illuminate\Http\Request;
use SPDP\KemajuanPermohonan;
use SPDP\Laporan;
use SPDP\Penilaian;
use SPDP\Services\PermohonanClass;
use Illuminate\Support\Facades\Hash;
use SPDP\Notifications\PendaftaranPengguna;
use Notification;
use SPDP\User;

class CreateUser
{
  
    public function store_pengguna($request)
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

