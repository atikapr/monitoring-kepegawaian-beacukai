@extends('layouts.app')

@section('title', 'Info Pangkat Pegawai')

@section('content')
<main class="mt-[120px]">
    <div class="max-w-[1600px] mx-auto px-10">
        <!-- Header Section with Animation -->
        <div class="flex justify-between items-center mb-10 animate-fade-in-down">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Info Pangkat Pegawai</h2>
                <p class="text-gray-500 mt-3 text-lg">Informasi lengkap pangkat seluruh pegawai</p>
            </div>
            
            <!-- Stats Summary -->
            <div class="flex space-x-8">
                <div class="bg-blue-50 rounded-lg p-6 shadow-sm">
                    <div class="text-base text-gray-500">Total Pegawai</div>
                    <div class="text-2xl font-bold text-blue-600">{{ count($pegawai) }}</div>
                </div>
            </div>
        </div>

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
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">No</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">NIP</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Nama Lengkap</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Kode Golongan Ruang</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">TMT Pangkat</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">TMT Berikutnya</th>
                            <th class="px-8 py-5 text-left text-base font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pegawai as $index => $p)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-8 py-5 text-base text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-8 py-5">
                                <div class="text-base font-medium text-gray-900">{{ $p['nip'] }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-base font-medium text-gray-900">{{ $p['nama_lengkap'] }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-4 py-2 text-base rounded-full bg-blue-100 text-blue-800 font-medium">
                                    {{ $p['kode_golongan_ruang'] }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-base text-gray-600">
                                    {{ \Carbon\Carbon::parse($p['tmt_pangkat'])->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-base text-gray-600">
                                    {{ \Carbon\Carbon::parse($p['tmt_berikutnya'])->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-8 py-5">
    @php
        $today = \Carbon\Carbon::now();
        $nextDate = \Carbon\Carbon::parse($p['tmt_berikutnya']);
        $daysRemaining = $today->diffInDays($nextDate, false);
    @endphp
    
    @if($daysRemaining < 0)
        <!-- Terlambat -->
        <span class="px-4 py-2 text-sm rounded-full bg-gray-200 text-gray-800">
            Terlambat
        </span>
    @elseif($daysRemaining <= 90)
        <!-- Segera -->
        <span class="px-4 py-2 text-sm rounded-full bg-red-100 text-red-800">
            Segera
        </span>
    @else
        <!-- Aktif -->
        <span class="px-4 py-2 text-sm rounded-full bg-green-100 text-green-800">
            Aktif
        </span>
    @endif
</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100">
                <div class="text-base text-gray-500">
                    Menampilkan {{ count($pegawai) }} pegawai
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
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