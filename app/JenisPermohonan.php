<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class JenisPermohonan extends Model
{
   protected $fillable = [
      'kod', 'huraian',


   ];

   public function permohonan()
   {
      return $this->hasOne('SPDP\Permohonan');
   }
}
