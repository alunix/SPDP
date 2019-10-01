<?php

namespace SPDP;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role','fakulti_id', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
{   
    
    return User::where('role', $role)->get();

}

public function permohonans(){

    return $this->hasMany('SPDP\Permohonan','id_penghantar');
}



public function fakulti(){

    return $this->belongsTo('SPDP\Fakulti','fakulti_id');
}








}
