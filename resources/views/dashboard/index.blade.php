@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="mt-[100px]">
    <div class="p-8 space-y-8 max-w-[1400px] mx-auto">
        <!-- Header Section with Animation -->
        <div class="flex items-center justify-between animate-fade-in-down">
            <h1 class="text-3xl font-bold text-gray-800">
                Welcome Back, {{ auth()->user()->name }}! 👋
            </h1>
            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Total Pegawai Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up animation-delay-100">
        <div class="px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-gray-500">Total Pegawai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_pegawai'] }}</p>
                </div>
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
            <div class="mt-6 flex items-center text-base text-green-600">
                <i class="fas fa-chart-line mr-2"></i>
                <span>Total keseluruhan pegawai</span>
            </div>
        </div>
    </div>

    <!-- Pegawai Aktif Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up animation-delay-200">
        <div class="px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-gray-500">Pegawai Aktif</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['pegawai_aktif'] }}</p>
                </div>
                <i class="fas fa-user-check text-green-600 text-2xl"></i>
            </div>
            <div class="mt-6 flex items-center text-base text-green-600">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Pegawai yang masih aktif</span>
            </div>
        </div>
    </div>

    <!-- Pegawai Non-Aktif Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up animation-delay-300">
        <div class="px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-gray-500">Pegawai Non-Aktif</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['pegawai_non_aktif'] }}</p>
                </div>
                <i class="fas fa-user-times text-red-600 text-2xl"></i>
            </div>
            <div class="mt-6 flex items-center text-base text-red-600">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>Pegawai tidak aktif</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in-up animation-delay-400">
        <div class="px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-lg font-medium text-gray-500">Quick Actions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">Menu</p>
                </div>
                
                    <i class="fas fa-bolt text-purple-600 text-2xl"></i>
                
            </div>
            <div class="mt-6 grid grid-cols-2 gap-4">
                <a href="{{ route('pegawai.index') }}" 
                   class="flex items-center px-4 py-3 bg-purple-100 rounded-lg text-base text-purple-600 hover:text-white hover:bg-purple-600 transform hover:scale-105 transition-transform">
                    <i class="fas fa-user-plus mr-2"></i> Data Pegawai
                </a>
                <a href="{{ route('monitoring.index') }}" 
                   class="flex items-center px-4 py-3 bg-purple-100 rounded-lg text-base text-purple-600 hover:text-white hover:bg-purple-600 transform hover:scale-105 transition-transform">
                    <i class="fas fa-chart-line mr-2"></i> Info Pegawai
                </a>
            </div>
        </div>
    </div>
</div>


        <!-- Profile KPPBC Section -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden animate-fade-in-up animation-delay-500">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Profil KPPBC TMP C Lhokseumawe</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Image and Address -->
                    <div class="space-y-6">
                        <div class="relative h-80 rounded-2xl overflow-hidden group">
                            <img src="{{ asset('images/kantor1.jpg') }}" 
                                 alt="Foto Kantor" 
                                 class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="bg-gray-50 rounded-xl p-6 transform hover:scale-105 transition-transform">
                            <h3 class="font-semibold text-gray-800 mb-3 text-lg">Alamat Kantor</h3>
                            <p class="text-gray-600 text-base flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-red-500"></i>
                                Jl. Iskandar Muda No.17, Kp. Jawa Lama, Kec. Banda Sakti, Kabupaten Aceh Utara, Aceh 24300
                            </p>
                        </div>
                    </div>

                    <!-- Info and Mission -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- About -->
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-8 transform hover:scale-105 transition-transform">
                            <h3 class="text-xl font-semibold text-blue-800 mb-4">Tentang Kami</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Berdasarkan PMK 183/PMK.01/2020 tentang Perubahan Atas Peraturan Menteri Keuangan Nomor 188/PMK.01/2016 tentang Organisasi dan Tata Kerja Instansi Vertikal DJBC, Kantor Pengawasan dan Pelayanan Bea dan Cukai Tipe Madya Pabean C Lhokseumawe adalah sebuah Instansi Vertikal di bawah Kantor Wilayah DJBC Aceh yang mempunyai tugas melaksanakan pengawasan dan pelayanan di bidang kepabeanan dan cukai dalam daerah wewenang bersangkutan berdasarkan peraturan perundang-undangan.
                            </p>
                        </div>

                        <!-- Vision Mission Motto Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Vision -->
                            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 transform hover:scale-105 transition-transform">
                                <h4 class="font-semibold text-blue-600 mb-3 text-lg">Visi</h4>
                                <p class="text-base text-gray-600">
                                    Menjadi Institusi Kepabeanan dan Cukai Terkemuka di Dunia.
                                </p>
                            </div>

                            <!-- Mission -->
                            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 transform hover:scale-105 transition-transform">
                                <h4 class="font-semibold text-green-600 mb-3 text-lg">Misi</h4>
                                <ul class="text-base text-gray-600 space-y-2">
                                    <li class="flex items-center">
                                        <span class="mr-2">📦</span> Memfasilitasi perdagangan
                                    </li>
                                    <li class="flex items-center">
                                        <span class="mr-2">🛡️</span> Melindungi masyarakat
                                    </li>
                                    <li class="flex items-center">
                                        <span class="mr-2">💰</span> Optimalisasi penerimaan
                                    </li>
                                </ul>
                            </div>

                            <!-- Motto -->
                            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 transform hover:scale-105 transition-transform">
                                <h4 class="font-semibold text-purple-600 mb-3 text-lg">Motto</h4>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-800">MAMEH</p>
                                    <p class="text-base text-gray-600 italic">
                                        "Menjalankan Amanah Dengan Setulus Hati"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
/* Animation Keyframes */
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

/* Animation Classes */
.animate-fade-in-down {
    animation: fadeInDown 0.5s ease-out;
}

.animate-fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}

/* Animation Delays */
.animation-delay-100 {
    animation-delay: 0.1s;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-300 {
    animation-delay: 0.3s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-500 {
    animation-delay: 0.5s;
}

/* Hover Effects */
.hover\:scale-105:hover {
    transform: scale(1.05);
}
</style>
@endpush