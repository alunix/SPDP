<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Penilaian;

class Permohonan extends Model
{
    protected $fillable = [
       'nama_penghantar', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title','jenis_permohonan',


   ];

   protected $table = 'permohonans';


   public function create(Request $request){
      //Handle file upload
      if($request->hasFile('file_link'))
        
      {

        $fileNameWithExt=$request -> file('file_link')->getClientOriginalName();

      // Get the full file name
        $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);            

      //Get the extension file name
        $extension = $request ->file('file_link')-> getClientOriginalExtension();
      //File name to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
      
      //Upload Pdf file
        $path =$request ->file('file_link')->storeAs('public/cadangan_program_baharu',$fileNameToStore);
      
      }
          else{
              $fileNameToStore = 'noPDF.pdf';
          }

      //Permohonan baharu
      $user_id = auth()->user()->id;
      // $nama_penghantar= auth()->user()->name;
     
          
          $permohonans= new Permohonan();
          // $permohonans -> nama_penghantar = $request -> input('nama_penghantar');
          $permohonans -> fakulti = $request -> input('fakulti');
          $permohonans -> doc_title =$request -> input('doc_title');
          $permohonans -> jenis_permohonan_id =$request -> input('jenis_permohonan_id');
          $permohonans -> file_name = $fileNameWithExt;
          $permohonans -> file_link = $fileNameToStore;
          $permohonans -> id_penghantar = $user_id;
          $permohonans -> status_permohonan = ('Belum disemak');
          $permohonans -> save();


   }



 public function user(){

    return $this->belongsTo('SPDP\User','id_penghantar');

 }

 public function penilaian(){
    // return $this->hasOne('SPDP\Penilaian','penilaianID');
     return $this->hasOne('SPDP\Penilaian','dokumen_id');


  

 }

 public function jenis_permohonan(){
  // return $this->hasOne('SPDP\Penilaian','penilaianID');
   return $this->belongsTo('SPDP\JenisPermohonan');




}

 

}
