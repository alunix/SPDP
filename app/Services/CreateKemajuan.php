<?php

namespace SPDP\Services;

use SPDP\Permohonan;
use SPDP\KemajuanPermohonan;

class CreateKemajuan
{
    public function create(Permohonan $permohonan)
    {
        $kj = new KemajuanPermohonan();
        $kj->permohonan_id = $permohonan->id;
        $kj->status_id = $permohonan->status_id;
        $kj->save();
    }
}
