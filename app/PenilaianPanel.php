<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class PenilaianPanel extends Model
{
    protected $fillable = [
        'permohonan_id'
  
  
     ];

public function permohonan(){
    return $this->belongsTo('SPDP\Permohonan','permohonanID');// set the foreign key (second parameter)

}

public function pelantik(){
    return $this->belongsTo('SPDP\User','id_pelantik');// set the foreign key (second parameter)

}

public function penilai(){
    return $this->belongsTo('SPDP\User','id_penilai');// set the foreign key (second parameter)

}


    

}
