<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Fakulti extends Model
{
    protected $primaryKey = 'fakulti_id';
    protected $table = 'fakultis';


public function permohonans(){

    return $this->users()->permohonans;
}

public function users(){

    return $this->hasMany('SPDP\User','fakulti_id');

}

    
}
