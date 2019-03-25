<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
   

    protected $fillable = [
        'laporan_id','penilaian_id_laporan',
        'laporan_panel_penilai',
        'laporan_panel_penilai_link',
        'perakuan_pjk',
       'perakuan_pjk_link',
       'perakuan_jppa',
       'perakuan_jppa_link',
       'perakuan_senat',
     'perakuan_senat_link',
  
  
     ];
    protected $primaryKey = 'dokumen_permohonan_id';
    protected $table = 'laporans';
    
    public function penilaian(){
    
        return $this->belongsTo('SPDP\Penilaian','penilaian_id_laporan');// set the foreign key (second parameter)
       }




}
