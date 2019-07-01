<?php

namespace SPDP\Services;

use SPDP\PenilaianPanel;
use SPDP\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SPDP\Notifications\PendaftaranPengguna;
use Notification;
use Carbon\Carbon;

class PenilaianPanelClass 
{
    
    public function create($permohonan,$selectedPenilai,$request)
    {   
        $currentDayTime = Carbon::now('Asia/Kuala_Lumpur');
        $dateTimeEnd=Carbon::parse( $request -> input('deadline')); 
        $from = Carbon::createFromFormat('Y-m-d H:s:i',$currentDayTime);
        $to = Carbon::createFromFormat('Y-m-d H:s:i',$dateTimeEnd);       
        $duration = $from->diffInDays($to); 

        $penilaian = new PenilaianPanel();
        $penilaian->permohonanID= $permohonan->permohonan_id;
        $penilaian->id_pelantik= auth()->user()->id;
        $penilaian->id_penilai=$selectedPenilai;
        $penilaian->tarikhAkhir=$to;
        $penilaian->tempoh=$duration;
        $penilaian->save();

        return $penilaian;
        
    }
}
