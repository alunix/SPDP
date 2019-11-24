<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class PenilaianPanel extends Model
{
    protected $fillable = [
        'permohonan_id'


    ];
    protected $table = 'penilaian_panels';

    public function permohonan()
    {
        return $this->belongsTo('SPDP\Permohonan', 'permohonan_id'); // set the foreign key (second parameter)

    }

    public function pelantik()
    {
        return $this->belongsTo('SPDP\User', 'id_pelantik'); // set the foreign key (second parameter)

    }

    public function penilai()
    {
        return $this->belongsTo('SPDP\User', 'id_penilai'); // set the foreign key (second parameter)

    }
}
