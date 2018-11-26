<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Penilaian;

class Program extends Model
{
    protected $fillable = [
       'lecturer_name', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title',


   ];

   protected $table = 'programs';


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

      //Create a new Program
      $lecturer_id = auth()->user()->id;
      $lecturer_name= auth()->user()->name;
     
          
          $programs= new Program();
          $programs -> lecturer_name = $request -> input('lecturer_name');
          $programs -> fakulti = $request -> input('fakulti');
          $programs -> doc_title =$request -> input('doc_title');
          $programs -> file_name = $fileNameWithExt;
          $programs -> file_link = $fileNameToStore;
          $programs -> lecturer_id = $lecturer_id;
          $programs -> status_program = ('Belum disemak');
          $programs -> save();


   }



 public function user(){

    return $this->belongsTo('SPDP\User');

 }

 public function penilaian(){
    // return $this->hasOne('SPDP\Penilaian','penilaianID');
     return $this->hasOne('SPDP\Penilaian','dokumen_id');


  

 }

 

}
