<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Program;
use SPDP\Laporan;

class Penilaian extends Model
{
    //

    protected $fillable = [
       'permohonan_id_penilaian'
 
 
    ];

    protected $table = 'penilaians';

    public function permohonan(){
    
      return $this->belongsTo('SPDP\Permohonan','permohonan_id_penilaian');// set the foreign key (second parameter)
     }

     public function laporan(){
    
      return $this->hasOne('SPDP\Laporan','penilaian_id_laporan');// set the foreign key (second parameter)
     }


     public function pjk(){
    
      return $this->belongsTo('SPDP\User','penilaian_pjk');// set the foreign key (second parameter)
     }

     public function panel_penilai(){
    
      return $this->belongsTo('SPDP\User','penilaian_panel_1');// set the foreign key (second parameter)
   }

   public function jppa(){
    
      return $this->belongsTo('SPDP\User','penilaian_jppa');// set the foreign key (second parameter)
   }

   public function senat(){
    
      return $this->belongsTo('SPDP\User','penilaian_senat');// set the foreign key (second parameter)
   }
     
     public function laporan_panel_penilai(){
      
    

     
     }

}
