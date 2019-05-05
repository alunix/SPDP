<?php

namespace SPDP\Http\Controllers;
use SPDP\Fakulti;
use SPDP\KemajuanPermohonan;
use SPDP\User;
use SPDP\Penilain;
use SPDP\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FakultiController extends Controller
{
    public function index()
    {
      
        return view ('fakulti.permohonan-baharu.blade.php');
    }

    public function permohonanBaru()
    {
      
        return view ('fakulti.permohonan-baharu');
    }
   
    public function analitik($id)
    {
        $permohonans = Fakulti::find($id)->permohonans;

        $fakulti_id = Fakulti::find($id)->fakulti_id;
        
        // $permohonans = Fakulti::find($fakulti_id)->with(['permohonans' => function($query)  {
        //         $query->where('permohonans.status_permohonan_id', 6)->orWhere('permohonans.status_permohonan_id',7); //specify which table created at to query
        //       }])->get()->sortBy('fakulti_id');

        $permohonans_id = Fakulti::find($id)->permohonans->sortBy('permohonan_id')->pluck('permohonan_id');

        $kemajuan_permohonan=KemajuanPermohonan::whereIn('permohonan_id',$permohonans_id)->groupBy('permohonan_id')->get();

        // $kp_6_7 = Fakulti::with(['dokumen_permohonans' => function($query) {
        //     $query->where('permohonans.status_permohonan_id', 6)->orWhere('permohonans.status_permohonan_id',7); //specify which table created at to query
        //   }])->get()->sortBy('fakulti_id');

      

  
     


     
      

        
        
        
    }
}
