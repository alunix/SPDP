<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class JenisPermohonan extends Model
{
    protected $fillable = [
        'jenis_permohonan_kod','jenis_permohonan_huraian',
  
  
     ];

     public function permohonan(){
        return $this->hasOne('SPDP\Permohonan');
     }
}
