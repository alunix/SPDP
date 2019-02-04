<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //


    protected $primaryKey = 'laporan_id';
    
    public function penilaian(){
    
        return $this->belongsTo('SPDP\Penilaian','penilaian_id_laporan');// set the foreign key (second parameter)
       }




}
