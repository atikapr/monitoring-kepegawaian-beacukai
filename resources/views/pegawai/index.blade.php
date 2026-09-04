@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
<main class="mt-[120px]">
    <div class="max-w-[1600px] mx-auto px-10">
        <!-- Header Section with Animation -->
        <div class="flex justify-between items-center mb-10 animate-fade-in-down">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Data Pegawai</h2>
                <p class="text-gray-500 mt-3 text-lg">Manajemen data seluruh pegawai</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Stats Card -->
                <div class="bg-blue-50 rounded-lg p-6 shadow-sm">
                    <div class="text-base text-gray-500">Total Pegawai</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $pegawai->total() }}</div>
                </div>
                
                <!-- Add Button -->
                <a href="{{ route('pegawai.create') }}" 
                   class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Pegawai</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg animate-fade-in-down">
            {{ session('success') }}
        </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fade-in-up">
            <!-- Table Controls -->
            <div class="p-8 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="tableSearch" 
                               class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-base" 
                               placeholder="Cari pegawai...">
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">NIP</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Nama Lengkap</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Jenjang Jabatan</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Seksi</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Status</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pegawai as $p)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-8 py-5">
                                <div class="text-base font-medium text-gray-900">{{ $p->nip }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-base font-medium text-gray-900">{{ $p->nama_lengkap }}</div>
                            </td>
                            <td class="px-8 py-5">
    <div class="inline-flex items-center">
        <span class="px-4 py-2 text-base rounded-full bg-blue-100 text-blue-800 font-medium whitespace-nowrap">
            {{ $p->jenjang_jabatan }}
        </span>
    </div>
</td>

                            <td class="px-8 py-5">
                                <div class="text-base text-gray-600">{{ $p->seksi ?? '-' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-base text-gray-600">{{ $p->status_pegawai }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex space-x-3">
                                    <a href="{{ route('pegawai.show', $p->nip) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('pegawai.edit', $p->nip) }}" 
                                       class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('pegawai.destroy', $p->nip) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Pagination -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="text-base text-gray-500">
                        Menampilkan {{ $pegawai->firstItem() }} sampai {{ $pegawai->lastItem() }} dari {{ $pegawai->total() }} pegawai
                    </div>
                    <div>
                        {{ $pegawai->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>

span {
    max-width: 200px; /* Batasi lebar maksimum */
    text-overflow: ellipsis; /* Potong teks jika terlalu panjang */
    overflow: hidden; /* Sembunyikan teks yang melebihi lebar */
    white-space: nowrap; /* Pastikan teks tetap dalam satu baris */
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fadeInDown 0.5s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out forwards;
    opacity: 0;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tableSearch');
    const rows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endpush