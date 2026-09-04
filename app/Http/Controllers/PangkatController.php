<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PangkatController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::whereNotNull('kode_golongan_ruang')
            ->whereNotNull('tmt_pangkat')
            ->get()
            ->map(function ($p) {
                $tmtBerikutnya = Carbon::parse($p->tmt_pangkat)->addYears(4);
                return [
                    'nip' => $p->nip,
                    'nama_lengkap' => $p->nama_lengkap,
                    'kode_golongan_ruang' => $p->kode_golongan_ruang,
                    'tmt_pangkat' => $p->tmt_pangkat,
                    'tmt_berikutnya' => $tmtBerikutnya
                ];
            })
            ->sortBy('tmt_berikutnya')
            ->values();

        return view('info-pegawai.pangkat.index', compact('pegawai'));
    }
}