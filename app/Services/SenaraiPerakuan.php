<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\PenilaianPanel;

class SenaraiPerakuan
{
    public function senaraiPerakuan()
    {
        $role = auth()->user()->role;
        switch ($role) {
            case 'pjk':
                return $this->pjk();
                break;
            case 'jppa':
                return $this->jppa();
                break;
            case 'penilai':
                return $this->penilai();
                break;
            case 'senat':
                return $this->senat();
                break;
            default:
                return null;
                break;
        }
    }

    public function pjk()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,fnama_kod', 'jenis_permohonan:id,jenis_permohonan_huraian'])
            ->where('jenis_permohonan_id', '!=', '8')->where('status_permohonan_id', '=', 3)->orWhere('status_permohonan_id', '=', 13)->paginate(10);
        return $permohonans;
    }

    public function penilai()
    {
        $user_id = auth()->user()->id;
        $pp = PenilaianPanel::where('id_penilai', $user_id)->get();
        $permohonans_id = $pp->pluck('permohonanID');
        if (empty((array) $permohonans_id)) { //check if array object is empty
            $permohonans = new Permohonan();
        } else {
            $permohonans = Permohonan::whereIn('permohonan_id', $permohonans_id)->where('status_permohonan_id', '=', '12')->paginate(10);
        }
        return $permohonans;
    }

    public function jppa()
    {
        $permohonans = Permohonan::where('status_permohonan_id', '=', '4')->orWhere('status_permohonan_id', '=', '14')->paginate(10);
        return $permohonans;
    }

    public function senat()
    {
        $permohonans = Permohonan::where('status_permohonan_id', '=', '5')->orWhere('status_permohonan_id', '=', '15')->paginate(10);
        return $permohonans;
    }
}
