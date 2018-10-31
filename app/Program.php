<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
       'lecturer_name', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title'


   ];

   protected $table = 'programs';

 

}
