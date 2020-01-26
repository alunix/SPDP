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

    private function fakulti($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id = Permohonan::where('id_penghantar', $user_id)->pluck('id')->toArray();
        
        return $this->userHavePermohonan($permohonan, $permohonans_id);
    }

    private function penilai($permohonan)
    {
        $permohonans = new SenaraiPermohonan();
        $permohonans = $permohonans->queryPermohonanBaru()->get();

        if (!$permohonans) {
            abort(404);
        };

        return $this->userHavePermohonan($permohonan, $permohonans->pluck('id')->toArray());
    }


    private function userHavePermohonan($permohonan, $permohonans_id)
    {
        // check whether user does have permohonans
        if (sizeof($permohonans_id) <= 0) {
            abort(404);
        }
        if (in_array($permohonan->id, $permohonans_id)) {
            return $this->show($permohonan);
        } else {
            abort(404);
        }
    }
}
