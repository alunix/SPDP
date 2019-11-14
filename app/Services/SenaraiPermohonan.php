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
        $permohonans =  DB::table("permohonans")
            ->join('penilaian_panels', 'penilaian_panels.permohonan_id', '=', 'permohonans.id')
            ->join('users', 'users.id', '=', 'penilaian_panels.id_penilai')
            ->where('permohonans.status_id', 2)
            ->where('penilaian_panels.id_penilai', $user_id)
            ->get();

        if (empty((array) $permohonans)) { //check if array object is empty
            $permohonans = new Permohonan();
        } else {
            $id = $permohonans->pluck('id');
            $permohonans = Permohonan::whereIn('id', $id)->get();
        }

        return $permohonans;
    }
    public function jppa()
    {
        $permohonans = Permohonan::where('jenis_id', 8)->where('status_id', 1)->orWhere('status_id', 4)->get();
        return $permohonans;
    }
    public function senat()
    {
        $permohonans = Permohonan::where('status_id', '=', '5')->get();
        return $permohonans;
    }
}
