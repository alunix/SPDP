<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class StatusPermohonan extends Model
{
    protected $fillable = [
        'status_permohonan_huraian',


    ];

    protected $primaryKey = 'status_id';
}
