<?php

namespace SPDP;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'role', 'fakulti_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
    {
        return User::where('role', $role)->get();
    }

    public function permohonans()
    {
        return $this->hasMany('SPDP\Permohonan', 'id_penghantar');
    }

    public function fakulti()
    {
        return $this->belongsTo('SPDP\Fakulti', 'fakulti_id');
    }
}
