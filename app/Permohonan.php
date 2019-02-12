<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Penilaian;
use SPDP\KemajuanPermohonan;

class Permohonan extends Model
{
    protected $fillable = [
       'nama_penghantar', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title','jenis_permohonan',


   ];

   protected $table = 'permohonans';

   
   
 public function user(){

    return $this->belongsTo('SPDP\User','id_penghantar');

 }

 public function penilaian(){
    // return $this->hasOne('SPDP\Penilaian','penilaianID');
     return $this->hasOne('SPDP\Penilaian','dokumen_id');
 }





 public function jenis_permohonan(){
  // return $this->hasOne('SPDP\Penilaian','penilaianID');
   return $this->belongsTo('SPDP\JenisPermohonan','jenis_permohonan_id');




}

 

}
