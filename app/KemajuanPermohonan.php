<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class KemajuanPermohonan extends Model
{
    protected $fillable = [
        'permohonan_id', 'status_permohonan' 
 
 
    ];

    public function statusPermohonan(){
        // return $this->hasOne('SPDP\Penilaian','penilaianID');
         return $this->belongsTo('SPDP\StatusPermohonan','status_permohonan');
     }
 
}
