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
        $data =  Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian']);
        switch ($role) {
            case 'pjk':
                $data->where('jenis_id', '!=', '8')->where('status_id', '=', '1');
                break;
            case 'jppa':
                $data->where('jenis_id', 8)->where('status_id', 1)->orWhere('status_id', 4);
                break;
            case 'penilai':
                $user_id = auth()->user()->id;
                $penilaian = PenilaianPanel::where('id_penilai', $user_id)->pluck('permohonan_id');
                $data->whereIn('id', $penilaian)->where('status_id', 2);
                break;
            case 'senat':
                $data->where('status_id', '=', '5');
                break;
            default:
                return;
                break;
        }
        return $data->paginate(10);
    }

    public function senaraiPerakuan()
    {
        $role = auth()->user()->role;
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian']);

        switch ($role) {
            case 'pjk':
                $permohonans->where('jenis_id', '!=', '8')->where('status_id', '=', 3)->orWhere('status_id', '=', 13);
                break;
            case 'jppa':
                $permohonans->where('status_id', '=', '4')->orWhere('status_id', '=', '14');
                break;
            case 'penilai':
                $user_id = auth()->user()->id;
                $pp = PenilaianPanel::where('id_penilai', $user_id)->get();
                $permohonans_id = $pp->pluck('permohonan_id');
                $permohonans->whereIn('id', $permohonans_id)->where('status_id', '=', '12');
                break;
            case 'senat':
                $permohonans->where('status_id', '=', '5')->orWhere('status_id', '=', '15');
                break;
            default:
                return;
                break;
        }

        return $permohonans->paginate(10);
    }
}
