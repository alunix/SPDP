<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
       'lecturer_name', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title','penilaianID',


   ];

   protected $table = 'programs';

 public function user(){

    return $this->belongsTo('SPDP\User');

 }

 public function penilaian(){
    // return $this->hasOne('SPDP\Penilaian','penilaianID');
    return $this->hasOne('SPDP\Penilaian','dokumen_id');

 }

 

}
