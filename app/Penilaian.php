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
       'laporan_panel_penilai','laporan_panel_penilai_link',
 
 
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
     
     public function laporan_panel_penilai($permohonan){
      
      $penilaian= $permohonan->penilaian;

      $id_penilai = $penilaian->penilaian_panel_1;
      $laporan_panel= Laporan::where('id_penghantar',$id_penilai)->where('dokumen_permohonan_id',$permohonan->permohonan_id)->orderBy('created_at', 'DESC')->first();
      return $laporan_panel;
     }

}
