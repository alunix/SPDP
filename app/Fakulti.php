<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Fakulti extends Model
{
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

    
}
