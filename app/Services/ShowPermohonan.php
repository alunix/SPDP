<?php

namespace SPDP\Services;

use SPDP\User;
use SPDP\Permohonan;
use SPDP\Services\SenaraiPermohonan;

class ShowPermohonan
{
    public function redirect($permohonan)
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                return $this->fakulti($permohonan);
                break;
            case 'penilai':
                return $this->penilai($permohonan);
                break;
            default:
                return $this->show($permohonan);
                break;
        }
    }

    public function show($permohonan)
    {
        $permohonan = Permohonan::with(['jenis_permohonan:id,huraian'])->where('id', $permohonan->id)
            ->withCount(['dokumens', 'laporans', 'kemajuan_permohonans'])->get();
        $dokumen = Permohonan::find($permohonan[0]->id)->latest_dokumen();
        return response()->json(['permohonan' => $permohonan[0], 'dokumen' => $dokumen]);
    }

    public function fakulti($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id = $user->permohonans->pluck('id')->toArray();

        $dp =  $this->userHavePermohonan($permohonan, $permohonans_id);
        if (!$dp) {
            abort(403);
        }
        return $this->show($permohonan);
    }

    public function penilai($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans = new SenaraiPermohonan();
        $permohonans = $permohonans->queryPermohonanBaru()->count();

        if (!$permohonans) {
            abort(404);
        };
        $permohonans_id = $permohonans->pluck('id')->toArray();
        return $this->userHavePermohonan($permohonan, $permohonans_id);
    }


    public function userHavePermohonan($permohonan, $permohonans_id)
    {
        // check whether user does have permohonans
        if (sizeof($permohonans_id) <= 0) {
            return false;
        }
        if (in_array($permohonan->id, $permohonans_id)) {
            return true;
        } else {
            return false;
        }
    }
}
