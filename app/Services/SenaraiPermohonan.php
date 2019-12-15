<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\PenilaianPanel;
use Debugbar;

class SenaraiPermohonan
{
    public function senaraiPermohonanBaru()
    {
        $data = $this->queryPermohonanBaru();
        return $data->paginate(10);
    }

    public function queryPermohonanBaru()
    {
        $role = auth()->user()->role;

        $data =  Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian', 'status_permohonan:status_id,huraian']);
        switch ($role) {
            case 'pjk':
                $data->where('jenis_id', '!=', 8)->where('status_id', '=', 1);
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
                $data->where('status_id', '=', 5);
                break;
            default:
                return null;
                break;
        }
        return $data;
    }

    public function senaraiPerakuan()
    {
        $data = $this->querySenaraiPerakuan();
        return $data->paginate(10);
    }

    public function querySenaraiPerakuan()
    {
        $role = auth()->user()->role;
        $datas = Permohonan::with(['user.fakulti:fakulti_id,kod', 'jenis_permohonan:id,huraian']);

        switch ($role) {
            case 'pjk':
                $datas->where('jenis_id', '!=', 8)->where('status_id', '=', 3)->orWhere('status_id', '=', 13);
                break;
            case 'jppa':
                $datas->where('status_id', '=', 4)->orWhere('status_id', '=', 14);
                break;
            case 'penilai':
                $user_id = auth()->user()->id;
                $pp = PenilaianPanel::where('id_penilai', $user_id)->get();
                $datas_id = $pp->pluck('permohonan_id');
                $datas->whereIn('id', $datas_id)->where('status_id', '=', 12);
                break;
            case 'senat':
                $datas->where('status_id', '=', 5)->orWhere('status_id', '=', 15);
                break;
            default:
                return;
                break;
        }
        return $datas;
    }
}
