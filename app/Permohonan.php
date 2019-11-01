<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SPDP\Penilaian;
use SPDP\KemajuanPermohonan;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships; //hasManyDeep package that is used to connect more than 3 tables

class Permohonan extends Model
{   


protected $fillable = [
    'nama_penghantar', 'fakulti' , 'file_link' ,'status_program','file_name','doc_title','jenis_permohonan', 'status_permohonan_id','id',
];

protected $table = 'permohonans';
protected $primaryKey = 'permohonan_id';

public function version_counts(){
    return $this->dokumen_permohonans()->count();
}

public function dokumen_permohonan(){
    return $this->dokumen_permohonans()->orderBy('versi', 'DESC')->first(); //retrieve dokumen terkini
}
   
public function user(){
    return $this->belongsTo('SPDP\User','id_penghantar');
}

public function fakulti(){
    return $this->belongsTo('SPDP\Fakulti','');

}

public function laporans(){
    return $this->hasManyThrough(
        'SPDP\Laporan', 
        'SPDP\DokumenPermohonan', 
        'permohonan_id', // Foreign key on users table...
        'dokumen_permohonan_id', // Foreign key on permohonan table...
        'permohonan_id', //Local key on permohonan table
        'dokumen_permohonan_id'); //Local key on users table
}

public function penilaian(){
    return $this->hasOne('SPDP\Penilaian','permohonan_id_penilaian');
 }
 
public function penilaian_panels(){
    return $this->hasMany('SPDP\PenilaianPanel','permohonanID');
}

public function status_permohonan(){
   return $this->belongsTo('SPDP\StatusPermohonan','status_permohonan_id');
}

public function kemajuan_permohonans(){
    return $this->hasMany('SPDP\KemajuanPermohonan','permohonan_id');
}

public function dokumen_permohonans(){
    return $this->hasMany('SPDP\DokumenPermohonan','permohonan_id');
}

public function jenis_permohonan(){
    return $this->belongsTo('SPDP\JenisPermohonan','jenis_permohonan_id');
}
}
