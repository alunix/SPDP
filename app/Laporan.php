<?php

namespace SPDP;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'laporan_id', 'penilaian_id_laporan',
    ];
    protected $primaryKey = 'dokumen_permohonan_id';
    protected $table = 'laporans';

    public function penilaian()
    {
        return $this->belongsTo('SPDP\Penilaian', 'penilaian_id_laporan'); // set the foreign key (second parameter)
    }

    public function id_penghantar_nama()
    {
        return $this->belongsTo('SPDP\User', 'id_penghantar');
    }

    public function laporan_penilai()
    {
        return $this->belongsTo('SPDP\User', 'id_penghantar'); // set the foreign key (second parameter)
    }
}
