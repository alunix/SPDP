<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    //

    protected $fillable = [
       'laporan_panel_penilai',
 
 
    ];

    protected $table = 'penilaians';



    public function program(){
        // return $this->belongsTo('SPDP\Program','dokumen_id');// set the foreign key (second parameter)
        return $this->belongsTo('SPDP\Program','penilaianID');// set the foreign key (second parameter)
    
     }

}
