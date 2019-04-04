<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class DokumenPermohonan extends Model
{
    protected $fillable = [
       
  
     ];
    protected $primaryKey = 'dokumen_permohonan_id';
    protected $table = 'dokumen_permohonans';
    
    public function penilaian(){
    
        return $this->belongsTo('SPDP\Penilaian','penilaian_id_laporan');// set the foreign key (second parameter)
       }

       public function permohonan(){
    
        return $this->belongsTo('SPDP\Permohonan','permohonan_id');// set the foreign key (second parameter)
       }

       public function laporans(){
    
        return $this->hasMany('SPDP\Laporan','dokumen_permohonan_id');// set the foreign key (second parameter)
       }
}
