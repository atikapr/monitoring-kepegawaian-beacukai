@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<main class="mt-[100px]">
    <div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Pegawai</h2>
            <a href="{{ route('pegawai.index') }}" class="text-beacukai-blue hover:text-blue-700">
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500">NIP</p>
                <p class="text-lg">{{ $pegawai->nip }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                <p class="text-lg">{{ $pegawai->nama_lengkap }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                <p class="text-lg">{{ $pegawai->kode_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Jenjang Jabatan</p>
                <p class="text-lg">{{ $pegawai->jenjang_jabatan }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Pendidikan Terakhir</p>
                <p class="text-lg">{{ $pegawai->pendidikan_terakhir }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Seksi</p>
                <p class="text-lg">{{ $pegawai->seksi }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Tahun Pensiun</p>
                <p class="text-lg">{{ $pegawai->tahun_pensiun }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Status Pegawai</p>
                <p class="text-lg">{{ $pegawai->status_pegawai }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Grading</p>
                <p class="text-lg">{{ $pegawai->grading }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">TMT Grading</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tmt_grading)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">Kode Golongan Ruang</p>
                <p class="text-lg">{{ $pegawai->kode_golongan_ruang }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">TMT Pangkat</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tmt_pangkat)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">MKP KGB Terakhir</p>
                <p class="text-lg">{{ $pegawai->mkg_kgb_terakhir }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">TMT KGB</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tmt_kgb)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">TMT Awal Penugasan</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tmt_awal_penugasan)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500">TMT Penempatan Seksi</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($pegawai->tmt_penempatan_seksi)->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
