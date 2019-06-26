<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class TetapanAliranKerja extends Model
{
    protected $table = 'tetapan_aliran_kerjas';
   protected $primaryKey = 'tetapan_id';

   public function pjk(){
    return $this->belongsTo('SPDP\User','id_pjk');
 }

 public function jppa(){
    return $this->belongsTo('SPDP\User','id_jppa');
 }
 public function senat(){
    return $this->belongsTo('SPDP\User','id_senat');
 }


}
