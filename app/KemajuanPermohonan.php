<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class KemajuanPermohonan extends Model
{
    protected $fillable = [
        'permohonan_id', 'status_id' 
 
 
    ];

    protected $table = 'kemajuan_permohonans';

    public function statusPermohonan(){
         return $this->belongsTo('SPDP\StatusPermohonan','status_id');
     }
 
}
