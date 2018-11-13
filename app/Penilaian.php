<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    //

    protected $fillable = [
       'laporan_panel_penilai','laporan_panel_penilai_link',
 
 
    ];

    protected $table = 'penilaians';
    //protected $primaryKey= 'id';


    public function program(){
        // return $this->belongsTo('SPDP\Program','dokumen_id');// set the foreign key (second parameter)
        // return $this->belongsTo('SPDP\Program','penilaianID');// set the foreign key (second parameter)
        return $this->belongsTo('SPDP\Program','penilaianID');
    
     }

     public function scopeLaporanPanelPenilai(){

        $penilaians = Penilaian::all();
        return view ('posts/senarai-penilaian-program')->with('penilaians',$penilaians);

     }

}
