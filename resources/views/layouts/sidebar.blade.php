<main class="mt-[100px] ml-64">
    <aside x-data="{ isOpen: true, dropdownOpen: false }" 
       :class="isOpen ? 'w-64' : 'w-20'" 
       class="fixed top-[100px] left-0 min-h-screen bg-gray-100 text-gray-900 shadow-lg transition-all duration-300">
    <nav class="p-4">
        <div class="space-y-6">
            <!-- Header/Logo Section with Toggle -->
            <div class="flex items-center justify-between py-4 px-2 mb-6">
                <h1 x-show="isOpen" class="text-xl font-bold tracking-wider text-blue-700 transition-all duration-300">SIMPEG BC</h1>
                <button @click="isOpen = !isOpen" class="p-2 rounded-lg hover:bg-blue-200/50">
                    <i class="fas" :class="isOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="space-y-4">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 no-underline {{ Request::is('dashboard*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                    <i class="fas fa-home text-lg" :class="isOpen ? 'w-8' : 'w-full text-center'"></i>
                    <span x-show="isOpen" class="ml-3">Dashboard</span>
                </a>

                <!-- Info Pegawai -->
                <a href="{{ route('monitoring.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 no-underline {{ Request::is('monitoring*') && !Request::is('monitoring/riwayat') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                    <i class="fas fa-briefcase text-lg" :class="isOpen ? 'w-8' : 'w-full text-center'"></i>
                    <span x-show="isOpen" class="ml-3">Info Pegawai</span>
                </a>

                <!-- Data Pegawai -->
                <a href="{{ route('pegawai.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 no-underline {{ Request::is('pegawai*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                    <i class="fas fa-users text-lg" :class="isOpen ? 'w-8' : 'w-full text-center'"></i>
                    <span x-show="isOpen" class="ml-3">Data Pegawai</span>
                </a>

                <!-- Monitoring Pegawai Dropdown -->
                <div x-data="{ dropdownOpen: false }" @click.away="">
                    <button @click="dropdownOpen = !dropdownOpen" 
                            class="flex items-center justify-between w-full px-4 py-3 rounded-lg transition-all duration-200 hover:bg-blue-200/50 text-gray-800">
                        <div class="flex items-center">
                            <i class="fas fa-id-card text-lg" :class="isOpen ? 'w-8' : 'w-full text-center'"></i>
                            <span x-show="isOpen" class="ml-3">Monitoring Pegawai</span>
                        </div>
                        <i x-show="isOpen" 
                           class="fas fa-caret-down transition-transform duration-200"
                           :class="{ 'transform rotate-180': dropdownOpen }">
                        </i>
                    </button>
                    
                    <div x-show="dropdownOpen && isOpen" 
                         class="pl-12 space-y-2 mt-2">
                        
                        <a href="{{ route('grading.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ Request::is('grading*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                            <i class="fas fa-chart-bar w-8 text-lg"></i>
                            <span class="ml-3">Grading</span>
                        </a>

                        <a href="{{ route('pangkat.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ Request::is('pangkat*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                            <i class="fas fa-medal w-8 text-lg"></i>
                            <span class="ml-3">Pangkat</span>
                        </a>

                        <a href="{{ route('kgb.index') }}" 
                           class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 no-underline {{ Request::is('kgb*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                            <i class="fas fa-money-check-alt w-8 text-lg"></i>
                            <span class="ml-3">KGB</span>
                        </a>
                    </div>
                </div>

                <!-- Laporan -->
                <a href="{{ route('laporan.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 no-underline {{ Request::is('laporan*') ? 'bg-blue-700 text-white shadow-md' : 'hover:bg-blue-200/50 text-gray-800' }}">
                    <i class="fas fa-chart-pie text-lg" :class="isOpen ? 'w-8' : 'w-full text-center'"></i>
                    <span x-show="isOpen" class="ml-3">Laporan</span>
                </a>

                
            </div>
        </div>
    </nav>
</aside>

</main>