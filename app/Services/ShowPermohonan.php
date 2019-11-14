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
                // $rp = new RedirectPermohonan();
                return $this->show($permohonan);
                break;
        }
    }

    public function show($permohonan)
    {
        $permohonan = Permohonan::with(['jenis_permohonan:id,jenis_permohonan_huraian'])->where('permohonan_id', $permohonan->permohonan_id)
            ->withCount(['dokumen_permohonans', 'laporans', 'kemajuan_permohonans'])->get();
        $dokumen = Permohonan::find($permohonan[0]->permohonan_id)->dokumen_permohonan();
        return response()->json(['permohonan' => $permohonan[0], 'dokumen' => $dokumen]);
    }

    public function fakulti($permohonan)
    {
        $dp =  $this->getBoolPermohonan($permohonan);
        if ($dp == false) {
            abort(403, 'Tidak dibenarkan');
        } else {
            return $this->showPermohonan($permohonan);
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
        $permohonans_id = $permohonans->pluck('permohonan_id');
        for ($i = 0; $i < count($permohonans_id); $i++) {
            if ($permohonan->permohonan_id == $permohonans_id[$i]) {
                $rp = new RedirectPermohonan();
                return $rp->redirectPermohonan($permohonan);
            }
        }
        abort(404);
    }


    public function getBoolPermohonan($permohonan)
    {
        if ($permohonan == null) {
            return false;
        }

        $isFakulti = $this->isFakulti();
        if ($isFakulti == false) {
            return true;
        } else {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $permohonans_id = $user->permohonans->pluck('permohonan_id');

            //check whether fakulti does have permohonans
            if (!sizeof($permohonans_id) > 0) {
                return false;
                die();
            }
            for ($i = 0; $i < count($permohonans_id); $i++) {
                if ($permohonan->permohonan_id == $permohonans_id[$i]) {
                    return true;
                }
            }
            return false;
        }
    }

    public function isFakulti()
    {
        $role = auth()->user()->role;

        if (!$role == 'fakulti') {
            return 0;
        } else {
            return 1;
        }
    }
}
