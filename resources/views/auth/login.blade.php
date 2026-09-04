<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMPEG BC</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/backgroundBc.jpg') }}');">
    <div class="min-h-screen flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm p-4">
        <div class="max-w-md w-full" x-data="{ isEmailFocused: false, isPasswordFocused: false }">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Top Design Element -->
                <div class="h-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>
                
                <div class="p-8">
                    <!-- Logo and Title Section -->
                    <div class="text-center mb-8 space-y-3">
                        <img src="{{ asset('images/logo-beacukai.png') }}" 
                             alt="Logo Bea Cukai" 
                             class="h-24 mx-auto mb-4 transform hover:scale-105 transition-transform duration-300">
                        <h2 class="text-3xl font-bold text-gray-800">SIMPEG BC</h2>
                        <p class="text-gray-600 text-sm">
                            Sistem Informasi Kepegawaian
                            <span class="block font-medium text-blue-600">KPPBC TMP C Lhokseumawe</span>
                        </p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <ul class="list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <!-- Email Field -->
                        <div>
                            <label for="email" 
                                   class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address
                            </label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       @focus="isEmailFocused = true"
                                       @blur="isEmailFocused = false"
                                       :class="{ 'ring-2 ring-blue-400': isEmailFocused }"
                                       class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 focus:outline-none transition duration-200 ease-in-out hover:border-blue-400">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" 
                                   class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       required
                                       @focus="isPasswordFocused = true"
                                       @blur="isPasswordFocused = false"
                                       :class="{ 'ring-2 ring-blue-400': isPasswordFocused }"
                                       class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 focus:outline-none transition duration-200 ease-in-out hover:border-blue-400">
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full flex justify-center items-center space-x-2 py-3 px-6 border border-transparent rounded-xl text-base font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:-translate-y-0.5 transition duration-200 ease-in-out shadow-lg hover:shadow-xl">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Sign In</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Bottom Design Element -->
                <div class="h-2 bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500"></div>
            </div>

            <!-- Footer Text -->
            <div class="mt-4 text-center text-sm text-white">
                <p>&copy; {{ date('Y') }} KPPBC TMP C Lhokseumawe. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Add Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>