<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Program;

class Penilaian extends Model
{
    //

    protected $fillable = [
       'laporan_panel_penilai','laporan_panel_penilai_link',
 
 
    ];

    protected $table = 'penilaians';
   

    public static function create(Request $request,$programID){
      $selectedPenilai = $request->input('checked');
      $penilaianPJK = auth()->user()->id;

      $penilaians = new Penilaian();
      $penilaians -> dokumen_id = $programID;
      $penilaians -> penilaian_pjk = $penilaianPJK;
      $penilaians -> penilaian_panel_1= $selectedPenilai[0];
     
      $penilaians -> save();

    }



    public function permohonan(){
    
      return $this->belongsTo('SPDP\Permohonan','dokumen_id');// set the foreign key (second parameter)
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
     
     public function scopeLaporanPanelPenilai(){
        $penilaians = Penilaian::all();
        return view ('posts/senarai-penilaian-program')->with('penilaians',$penilaians);
     }

}
