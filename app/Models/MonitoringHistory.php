<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringHistory extends Model
{
    protected $fillable = [
        'nip',
        'jenis_info',
        'tmt',
        'tmt_berikutnya',
        'status_tindak_lanjut',
        'catatan',
        'tanggal_tindak_lanjut'
    ];

    protected $dates = [
        'tmt',
        'tmt_berikutnya',
        'tanggal_tindak_lanjut'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}