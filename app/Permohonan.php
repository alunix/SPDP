<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Penilaian;
use SPDP\KemajuanPermohonan;

class Permohonan extends Model
{
    protected $fillable = [
       'nama_penghantar', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title','jenis_permohonan', 'status_permohonan_id','id',


   ];

   protected $table = 'permohonans';
   protected $primaryKey = 'permohonan_id';

   public function version_counts(){
    
    return $this->dokumen_permohonans()->count();
 }

 public function dokumen_permohonan(){
    return $this->dokumen_permohonans()->orderBy('versi', 'DESC')->first(); //retrieve dokumen terkini
}
   
 public function user(){

    return $this->belongsTo('SPDP\User','id_penghantar');

 }

 public function penilaian(){
    // return $this->hasOne('SPDP\Penilaian','penilaianID');
     return $this->hasOne('SPDP\Penilaian','permohonan_id_penilaian');
 }

 public function status_permohonan(){
   // return $this->hasOne('SPDP\Penilaian','penilaianID');
    return $this->belongsTo('SPDP\StatusPermohonan','status_permohonan_id');
}

public function kemajuan_permohonans(){
   // return $this->hasOne('SPDP\Penilaian','penilaianID');
    return $this->hasMany('SPDP\KemajuanPermohonan','permohonan_id');
}

public function dokumen_permohonans(){
    return $this->hasMany('SPDP\DokumenPermohonan','permohonan_id');
}

 public function jenis_permohonan(){
  // return $this->hasOne('SPDP\Penilaian','penilaianID');
   return $this->belongsTo('SPDP\JenisPermohonan','jenis_permohonan_id');




}

 

}
