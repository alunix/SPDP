<?php

namespace SPDP\Services;

use SPDP\Penilaian;
use SPDP\Permohonan;
use SPDP\User;
use SPDP\Laporan;
use SPDP\Services\LaporanClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SPDP\Notification;


class NotificationClass 
{
    
    public function create(Request $request,$status,$location,$userFired,$userToNotify)
    {   
        $notification = new Notification();
        $notification->notificationDetails= $status;
        $notification->notificationLocation = $location;
        $notification->userFired = $userFired;
        $notification->userToNotify = $userToNotify;
        $notification->save();

        
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
