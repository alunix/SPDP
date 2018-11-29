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
      $penilaians -> penilaian_panel_2 = $selectedPenilai[1];
      $penilaians -> penilaian_panel_3 = $selectedPenilai[2];
      $penilaians -> save();

    }

   

    public function program(){
    
      return $this->belongsTo('SPDP\Program','dokumen_id');// set the foreign key (second parameter)
     }
     
     public function scopeLaporanPanelPenilai(){
        $penilaians = Penilaian::all();
        return view ('posts/senarai-penilaian-program')->with('penilaians',$penilaians);
     }

}
