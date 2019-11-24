<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class StatusPermohonan extends Model
{
    protected $fillable = [
        'huraian',


    ];

    protected $primaryKey = 'status_id';
}
