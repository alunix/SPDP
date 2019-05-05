<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;


class Fakulti extends Model
{

    use \Staudenmeir\EloquentHasManyDeep\HasRelationships; //hasManyDeep package that is used to connect more than 3 tables
    protected $primaryKey = 'fakulti_id';
    protected $table = 'fakultis';


public function permohonans(){

    return $this->hasManyThrough(
                'SPDP\Permohonan', 
                'SPDP\User', 
                'fakulti_id', // Foreign key on users table...
                'id_penghantar', // Foreign key on permohonan table...
                'fakulti_id', //Local key on permohonan table
                'id'); //Local key on users table
}

public function users(){
    return $this->hasMany('SPDP\User','fakulti_id');
}


public function kemajuan_permohonans(){
    
    return $this->hasManyDeep(
        
        'SPDP\KemajuanPermohonan',
        ['SPDP\User', 'SPDP\Permohonan'], // Intermediate models, beginning at the far parent (Country).
        [
           'fakulti_id', // Foreign key on the "users" table.
           'id_penghantar',    // Foreign key on the "posts" table.
           'permohonan_id'     // Foreign key on the "comments" table.
        ],
        [
          'fakulti_id', // Local key on the "countries" table.
          'id', // Local key on the "users" table.
          'permohonan_id'  // Local key on the "posts" table.
        ]
    );
}

public function dokumen_permohonans(){
    
    return $this->hasManyDeep(
        
        'SPDP\DokumenPermohonan',
        ['SPDP\User', 'SPDP\Permohonan'], // Intermediate models, beginning at the far parent (Country).
        [
           'fakulti_id', // Foreign key on the "users" table.
           'id_penghantar',    // Foreign key on the "posts" table.
           'permohonan_id'     // Foreign key on the "comments" table.
        ],
        [
          'fakulti_id', // Local key on the "countries" table.
          'id', // Local key on the "users" table.
          'permohonan_id'  // Local key on the "posts" table.
        ]
    );
}



    
}
