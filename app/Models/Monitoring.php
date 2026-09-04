<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'nip',
        'jenis_info',
        'tmt_berikutnya',
        'status_tindak_lanjut',
        'keterangan',
        'catatan'
    ];

    protected $dates = [
        'tmt_berikutnya'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }

    /**
     * Mendapatkan data monitoring berdasarkan status
     */
    public function getMonitoringData()
    {
        return [
            'belum' => $this->where('status_tindak_lanjut', 'Belum')->get(),
            'sudah' => $this->where('status_tindak_lanjut', 'Sudah')->get(),
            'tidak' => $this->where('status_tindak_lanjut', 'Tidak')->get()
        ];
    }
}
