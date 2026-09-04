<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GradingController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::whereNotNull('grading')
            ->whereNotNull('tmt_grading')
            ->get()
            ->map(function ($p) {
                $tmtBerikutnya = Carbon::parse($p->tmt_grading)->addYears(2);
                return [
                    'nip' => $p->nip,
                    'nama_lengkap' => $p->nama_lengkap,
                    'grading' => $p->grading,
                    'tmt_grading' => $p->tmt_grading,
                    'tmt_berikutnya' => $tmtBerikutnya
                ];
            })
            ->sortBy('tmt_berikutnya')
            ->values();

        return view('info-pegawai.grading.index', compact('pegawai'));
    }
}