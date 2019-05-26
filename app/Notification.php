<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    


public function status(){
    return $this->belongsTo('SPDP\StatusPermohonan','notificationDetails');
}



}
