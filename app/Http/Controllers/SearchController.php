<?php

namespace SPDP\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use SPDP\User;
use SPDP\Permohonan;
use SPDP\DokumenPermohonan;
use SPDP\Laporan;
use SPDP\Fakulti;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{   

    public function search(Request $request){

        $role = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                    return $this->fakulti($request);
                break;
            default:
                   return $this->default($request);
                break;
        }
    
   
    }

    public function fakulti($request){

        $q = $request->get ( 'input-search' );
        $fakulti_id = auth()->user()->fakulti_id;

        $permohonans=  DB::table("permohonans") 
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->join('fakultis','fakultis.fakulti_id','=','users.fakulti_id')
        ->where('users.fakulti_id',$fakulti_id)
        ->where('doc_title','LIKE','%'.$q.'%')
        ->get();

        $dokumens=  DB::table("dokumen_permohonans") 
        ->join('permohonans','permohonans.permohonan_id','=','dokumen_permohonans.permohonan_id')
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->join('fakultis','fakultis.fakulti_id','=','users.fakulti_id')
        ->where('users.fakulti_id',$fakulti_id)
        ->where('file_name','LIKE','%'.$q.'%')
        ->get();

        
        $laporans=  DB::table("laporans") 
        ->join('dokumen_permohonans','dokumen_permohonans.dokumen_permohonan_id','=','laporans.dokumen_permohonan_id')
        ->join('permohonans','permohonans.permohonan_id','=','dokumen_permohonans.permohonan_id')
        ->join('users','users.id','=','permohonans.id_penghantar')
        ->join('fakultis','fakultis.fakulti_id','=','users.fakulti_id')
        ->where('users.fakulti_id',$fakulti_id)
        ->where('tajuk_fail','LIKE','%'.$q.'%')
        ->get();

        $msg = [
            'message' => 'Carian tidak dapat mencari ',
           ];
    
        $total_count = count($permohonans)+count($dokumens)+count($laporans);
        return view('search-result')->with('permohonans',$permohonans)->with('dokumens',$dokumens)->with('laporans',$laporans)->with('total_count',$total_count)->withQuery ( $q );
        
        
    }

    public function default($request){
        $q = $request->get ( 'input-search' );
        $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
        $permohonans =  Permohonan::where('doc_title','LIKE','%'.$q.'%')->get();
        $dokumens= DokumenPermohonan::where('file_name','LIKE','%'.$q.'%')->get();
        $laporan= Laporan::where('tajuk_fail','LIKE','%'.$q.'%')->get();
        
        $msg = [
            'message' => 'Carian tidak dapat mencari ',
           ];
    
        $total_count = count($users) +count($permohonans)+count($dokumens)+count($laporan);
        return view('search-result')->with('permohonans',$permohonans)->with('dokumens',$dokumens)->with('laporans',$laporan)->with('users',$users)->with('total_count',$total_count)->withQuery ( $q );
    }
}
