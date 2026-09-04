<header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-full mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <!-- Left side - Logo and Title -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo-beacukai.png') }}" 
                         alt="Logo Bea Cukai" 
                         class="h-12 w-auto transform hover:scale-105 transition-transform duration-200">
                </div>
                <div class="hidden lg:block">
                    <h1 class="text-xl font-bold text-gray-800 leading-tight">
                        Sistem Informasi Kepegawaian
                        <span class="block text-blue-600 text-lg">
                            KPPBC TMP C Lhokseumawe
                        </span>
                    </h1>
                </div>
            </div>

            

            <!-- Right side - User Profile -->
            <div x-data="{ isOpen: false }" class="relative" @keydown.escape.window="isOpen = false">
                <button @click="isOpen = !isOpen"
                        type="button"
                        class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <!-- User Avatar -->
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 flex items-center justify-center shadow-lg">
                            <span class="text-white font-semibold text-lg">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </span>
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                    
                    <!-- User Info -->
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-semibold text-gray-800">
                            {{ auth()->user()->name ?? 'User' }}
                        </div>
                        <div class="text-xs text-gray-500">Administrator</div>
                    </div>

                    <!-- Dropdown Arrow -->
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                         :class="{'rotate-180': isOpen}"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="isOpen"
                    x-cloak
                     @click.outside="isOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 py-1">
                    
                    <!-- User Profile Section -->
                    <div class="px-4 py-3 border-b">
                        <div class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? 'User' }}</div>
                        <div class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'email@example.com' }}</div>
                    </div>

                    <!-- Logout -->
                    <div class="border-t">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>