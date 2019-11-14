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
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $penilaian = new Penilaian();
        $penilaian->permohonan_id_penilaian = $permohonan->id;

        switch ($role) {
            case 'pjk':
                $penilaian->penilaian_pjk = $user_id;
                break;
            case 'jppa':
                $penilaian->penilaian_jppa = $user_id;
                break;
            default:
                return null;
                break;
        }
        $penilaian->status_penilaian = 1;
        $penilaian->save();
        return $penilaian;
    }
}
