<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\Penilaian;
use SPDP\PenilaianPanel;
use Illuminate\Support\Facades\DB;

class SenaraiPermohonan
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                return null;
                break;
        }
    }

    public function pjk()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,fnama_kod', 'jenis_permohonan:id,jenis_permohonan_huraian'])
            ->where('jenis_permohonan_id', '!=', '8')->where('status_permohonan_id', '=', '1')->paginate(10);
        return response()->json($permohonans);
    }

    public function perakuanPjk()
    {
        $permohonans = Permohonan::with(['user.fakulti:fakulti_id,fnama_kod', 'jenis_permohonan:id,jenis_permohonan_huraian'])->where('jenis_permohonan_id', '!=', '8')->where('status_permohonan_id', '=', 3)->paginate(10);
        return response()->json($permohonans);
    }

    public function penilai()
    {
        $user_id = auth()->user()->id;
        $permohonans =  DB::table("permohonans")
            ->join('penilaian_panels', 'penilaian_panels.permohonanID', '=', 'permohonans.permohonan_id')
            ->join('users', 'users.id', '=', 'penilaian_panels.id_penilai')
            ->where('permohonans.status_permohonan_id', 2)
            ->where('penilaian_panels.id_penilai', $user_id)
            ->get();

        if (empty((array) $permohonans)) { //check if array object is empty
            $permohonans = new Permohonan();
        } else {
            $id = $permohonans->pluck('permohonan_id');
            $permohonans = Permohonan::whereIn('permohonan_id', $id)->get();
        }

        return $permohonans;
    }
    public function jppa()
    {

        $permohonans = Permohonan::where('jenis_permohonan_id', 8)->where('status_permohonan_id', 1)->orWhere('status_permohonan_id', 4)->get();

        return $permohonans;
    }
    public function senat()
    {
        $permohonans = Permohonan::where('status_permohonan_id', '=', '5')->get();
        return $permohonans;
    }
}
