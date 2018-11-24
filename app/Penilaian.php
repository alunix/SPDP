<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Penilaian extends Model
{
    //

    protected $fillable = [
       'laporan_panel_penilai','laporan_panel_penilai_link',
 
 
    ];

    protected $table = 'penilaians';
    //protected $primaryKey= 'id';

   public function updatePenilaianPJK(Request$request){


   }

    public function program(){
     
     
      // return $this->belongsTo('SPDP\Program','dokumen_id');// set the foreign key (second parameter)
      return $this->belongsTo('SPDP\Program','dokumen_id');// set the foreign key (second parameter)

      

       
        
        
       
    
     }

     public function scopeLaporanPanelPenilai(){

        $penilaians = Penilaian::all();
        return view ('posts/senarai-penilaian-program')->with('penilaians',$penilaians);

     }

}
