@extends('layouts.app')

@section('title', 'Edit Data Pegawai')

@section('content')
<main class="mt-[100px]">
    <div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Data Pegawai</h2>

        <form action="{{ route('pegawai.update', $pegawai->nip) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIP <span class="text-red-500">*</span></label>
                    <input type="text" name="nip" value="{{ old('nip', $pegawai->nip) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 focus:ring-blue-200 transition duration-150" 
                           required>
                    @error('nip')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required>

                    @error('nama_lengkap')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="kode_kelamin" class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 

                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('kode_kelamin', $pegawai->kode_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('kode_kelamin', $pegawai->kode_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('kode_kelamin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenjang Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="jenjang_jabatan" value="{{ old('jenjang_jabatan', $pegawai->jenjang_jabatan) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required>

                    @error('jenjang_jabatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                    <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 

                    @error('pendidikan_terakhir')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Seksi</label>
                    <input type="text" name="seksi" value="{{ old('seksi', $pegawai->seksi) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150"> 
@error('seksi') 

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 

                    @error('tanggal_lahir')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Pensiun <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun_pensiun" value="{{ old('tahun_pensiun', $pegawai->tahun_pensiun) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required>

                    @error('tahun_pensiun')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pegawai <span class="text-red-500">*</span></label>
                    <input type="text" name="status_pegawai" value="{{ old('status_pegawai', $pegawai->status_pegawai) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('status_pegawai')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Grading</label>
                    <input type="text" name="grading" value="{{ old('grading', $pegawai->grading) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150"> 
@error('grading')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TMT Grading</label>
                    <input type="date" name="tmt_grading" value="{{ old('tmt_grading', $pegawai->tmt_grading) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150"> 
@error('tmt_grading')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Golongan Ruang <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_golongan_ruang" value="{{ old('kode_golongan_ruang', $pegawai->kode_golongan_ruang) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('kode_golongan_ruang') 

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TMT Pangkat <span class="text-red-500">*</span></label>
                    <input type="date" name="tmt_pangkat" value="{{ old('tmt_pangkat', $pegawai->tmt_pangkat) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('tmt_pangkat') 

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">MKP KGB Terakhir <span class="text-red-500">*</span></label>
                    <input type="text" name="mkg_kgb_terakhir" value="{{ old('mkg_kgb_terakhir', $pegawai->mkg_kgb_terakhir) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('mkg_kgb_terakhir')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TMT KGB <span class="text-red-500">*</span></label>
                    <input type="date" name="tmt_kgb" value="{{ old('tmt_kgb', $pegawai->tmt_kgb) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('tmt_kgb')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TMT Awal Penugasan <span class="text-red-500">*</span></label>
                    <input type="date" name="tmt_awal_penugasan" value="{{ old('tmt_awal_penugasan', $pegawai->tmt_awal_penugasan) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150" 
required> 
@error('tmt_awal_penugasan')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">TMT Penempatan Seksi</label>
                    <input type="date" name="tmt_penempatan_seksi" value="{{ old('tmt_penempatan_seksi', $pegawai->tmt_penempatan_seksi) }}" 
                           class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150"> 
@error('tmt_penempatan_seksi') 

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" 
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150"> 
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
</main>
@endsection
