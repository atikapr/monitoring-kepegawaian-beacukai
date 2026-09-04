<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pegawai' => Pegawai::count(),
            'pegawai_aktif' => Pegawai::where('status_pegawai', 'Aktif')->count(),
            'pegawai_non_aktif' => Pegawai::where('status_pegawai', '!=', 'Aktif')->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}
