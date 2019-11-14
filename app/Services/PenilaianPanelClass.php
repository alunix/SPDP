<?php

namespace SPDP\Services;

use SPDP\PenilaianPanel;
use Notification;
use Carbon\Carbon;
use Debugbar;

class PenilaianPanelClass
{

    public function create($permohonan, $request)
    {
        $currentDayTime = Carbon::now('Asia/Kuala_Lumpur');
        $dateTimeEnd = Carbon::parse($request->input('due_date'));
        $selectedPenilai = $request->input('selectedPenilai');
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $currentDayTime);
        $to = Carbon::createFromFormat('Y-m-d H:s:i', $dateTimeEnd);
        $duration = $from->diffInDays($to);

        foreach ($selectedPenilai as $penilai) {
            $penilaian = new PenilaianPanel();
            $penilaian->permohonan_id = $permohonan->id;
            $penilaian->id_pelantik = auth()->user()->id;
            $penilaian->id_penilai = $penilai;
            $penilaian->due_date = $to;
            $penilaian->tempoh = $duration;
            $penilaian->save();
        }
    }
}
