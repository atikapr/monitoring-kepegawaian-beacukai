<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::orderBy('updated_at', 'desc')->paginate(10);
    return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:18|unique:pegawai',
            'nama_lengkap' => 'required|string|max:255',
            'kode_kelamin' => 'required|in:L,P',
            'jenjang_jabatan' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'seksi' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tahun_pensiun' => 'required|integer',
            'status_pegawai' => 'required|string|max:255',
            'grading' => 'nullable|string|max:255',
            'tmt_grading' => 'nullable|date',
            'kode_golongan_ruang' => 'required|string|max:255',
            'tmt_pangkat' => 'required|date',
            'mkg_kgb_terakhir' => 'required|string|max:255',
            'tmt_kgb' => 'required|date',
            'tmt_awal_penugasan' => 'required|date',
            'tmt_penempatan_seksi' => 'nullable|date',
        ]);

        // Hitung usia berdasarkan tanggal lahir
        $validated['usia'] = date_diff(date_create($validated['tanggal_lahir']), date_create('today'))->y;

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'kode_kelamin' => 'required|in:L,P',
            'jenjang_jabatan' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'seksi' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tahun_pensiun' => 'required|integer',
            'status_pegawai' => 'required|string|max:255',
            'grading' => 'nullable|string|max:255',
            'tmt_grading' => 'nullable|date',
            'kode_golongan_ruang' => 'required|string|max:255',
            'tmt_pangkat' => 'required|date',
            'mkg_kgb_terakhir' => 'required|string|max:255',
            'tmt_kgb' => 'required|date',
            'tmt_awal_penugasan' => 'required|date',
            'tmt_penempatan_seksi' => 'nullable|date',
        ]);

        // Hitung usia berdasarkan tanggal lahir
        $validated['usia'] = date_diff(date_create($validated['tanggal_lahir']), date_create('today'))->y;
        $validated['updated_at'] = now();

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}