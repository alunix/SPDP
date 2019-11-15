<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\PenilaianPanel;
use Illuminate\Support\Facades\DB;

class SenaraiPermohonan
{
    public function index()
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
                return [];
                break;
        }
    }

    public function pjk()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian'])
            ->where('jenis_id', '!=', '8')->where('status_id', '=', '1')->paginate(10);
        return $permohonans;
    }

    public function penilai()
    {
        $user_id = auth()->user()->id;
        $penilaian = PenilaianPanel::where('id_penilai', $user_id)->pluck('permohonan_id');
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian'])->whereIn('id', $penilaian)->where('status_id', 2)->paginate(10);
        return $permohonans;
    }
    public function jppa()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian'])->where('jenis_id', 8)->where('status_id', 1)->orWhere('status_id', 4)->paginate(10);
        return $permohonans;
    }
    public function senat()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian'])->where('status_id', '=', '5')->paginate(10);
        return $permohonans;
    }
}
