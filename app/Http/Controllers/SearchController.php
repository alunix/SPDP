<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use SPDP\User;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\Laporan;

class SearchController extends Controller
{   

    public function search(Request $request){
    
    $q = $request->get ( 'input-search' );
    $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    $permohonan =  Permohonan::where('doc_title','LIKE','%'.$q.'%')->get();
    $dokumens= DokumenPermohonan::where('file_name','LIKE','%'.$q.'%')->get();
    $laporan= Laporan::where('tajuk_fail','LIKE','%'.$q.'%')->get();
	
	$msg = [
		'message' => 'Carian tidak dapat mencari ',
	   ];

    if(count($users) > 0||count($permohonan)>0||count($dokumens)>0||count($laporan)>0){
       $total_count = count($users) +count($permohonan)+count($dokumens)+count($laporan);
        return view('search-result')->with('permohonans',$permohonan)->with('dokumens',$dokumens)->with('laporans',$laporan)->with('users',$users)->with('total_count',$total_count)->withQuery ( $q );
    }
    else 
        return view ('search-result')->with($msg); 
    }
}
