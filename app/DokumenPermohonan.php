<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class DokumenPermohonan extends Model
{
    protected $fillable = [
       
  
     ];
    protected $primaryKey = 'laporan_id';
    protected $table = 'laporans';
    
    public function penilaian(){
    
        return $this->belongsTo('SPDP\Penilaian','penilaian_id_laporan');// set the foreign key (second parameter)
       }
}
