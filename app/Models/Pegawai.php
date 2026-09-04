<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'kode_kelamin',
        'jenjang_jabatan',
        'pendidikan_terakhir',
        'seksi',
        'usia',
        'tanggal_lahir',
        'tahun_pensiun',
        'status_pegawai',
        'grading',
        'tmt_grading',
        'kode_golongan_ruang',
        'tmt_pangkat',
        'mkg_kgb_terakhir',
        'tmt_kgb',
        'tmt_awal_penugasan',
        'tmt_penempatan_seksi',
        'updated_at'
    ];

    protected $dates = [
        'tanggal_lahir',
        'tmt_grading',
        'tmt_pangkat',
        'tmt_kgb',
        'tmt_awal_penugasan',
        'tmt_penempatan_seksi'
    ];
}

