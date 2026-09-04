<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KGBController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::whereNotNull('tmt_kgb')
            ->get()
            ->map(function ($p) {
                $tmtBerikutnya = Carbon::parse($p->tmt_kgb)->addYears(2);
                return [
                    'nip' => $p->nip,
                    'nama_lengkap' => $p->nama_lengkap,
                    'mkg_kgb_terakhir' => $p->mkg_kgb_terakhir,
                    'tmt_kgb' => $p->tmt_kgb,
                    'tmt_berikutnya' => $tmtBerikutnya
                ];
            })
            ->sortBy('tmt_berikutnya')
            ->values();

        return view('info-pegawai.kgb.index', compact('pegawai'));
    }
}