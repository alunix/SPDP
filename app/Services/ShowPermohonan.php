<?php

namespace SPDP\Services;

use SPDP\User;
use SPDP\Services\RedirectPermohonan;
use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\Services\KemajuanPermohonanClass;
use SPDP\Services\SenaraiPermohonan;
use SPDP\Support\Collection;
use SPDP\DokumenPermohonan;

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
        $dp =  $this->getBoolPermohonan($permohonan);
        if ($dp == false) {
            abort(403, 'Tidak dibenarkan');
        } else {
            return $this->show($permohonan);
        }
    }

    public function penilai($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans = new SenaraiPermohonan();
        $permohonans = $permohonans->penilai();
        if ($permohonans == null) {
            abort(404);
        }
        $permohonans_id = $permohonans->pluck('id');
        for ($i = 0; $i < count($permohonans_id); $i++) {
            if ($permohonan->id == $permohonans_id[$i]) {
                return $this->show($permohonan);
            }
        }
        abort(404);
    }


    public function getBoolPermohonan($permohonan)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $permohonans_id = $user->permohonans->pluck('id');

        //check whether fakulti does have permohonans
        if (!sizeof($permohonans_id) > 0) {
            return false;
            die();
        }
        for ($i = 0; $i < count($permohonans_id); $i++) {
            if ($permohonan->id == $permohonans_id[$i]) {
                return true;
            }
        }
        return false;
    }
}
