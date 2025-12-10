<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Keuangan Pribadi')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm smooth-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <img src="{{ asset('images/logo.webp') }}" alt="Keuangan Pribadi Logo" class="h-8 w-auto rounded-lg group-hover:shadow-lg transition-all duration-300">
                        <span class="hidden sm:inline text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent dark:from-blue-400 dark:to-blue-500">ReKa</span>
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition focus-ring">
                    <svg id="menu-icon" class="w-6 h-6 text-gray-700 dark:text-gray-300 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center gap-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="relative text-sm font-medium smooth-transition group {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2">
                            Dashboard
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs('dashboard') ? 'w-full' : 'w-0 group-hover:w-full' }} h-0.5 bg-gradient-primary transition-all duration-300"></span>
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="relative text-sm font-medium smooth-transition group {{ request()->routeIs('transaksi.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2">
                            Transaksi
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs('transaksi.*') ? 'w-full' : 'w-0 group-hover:w-full' }} h-0.5 bg-gradient-primary transition-all duration-300"></span>
                        </a>
                        <a href="{{ route('laporan') }}" class="relative text-sm font-medium smooth-transition group {{ request()->routeIs('laporan') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2">
                            Laporan
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs('laporan') ? 'w-full' : 'w-0 group-hover:w-full' }} h-0.5 bg-gradient-primary transition-all duration-300"></span>
                        </a>
                    @endauth
                </div>

                <!-- User Menu - Desktop -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 text-sm font-medium smooth-transition focus-ring rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="hidden sm:inline max-w-xs truncate">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </button>
                            
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-xl z-10 border border-gray-200 dark:border-gray-600 overflow-hidden animate-in fade-in duration-200">
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 smooth-transition flex items-center gap-2 group/btn">
                                        <svg class="w-4 h-4 group-hover/btn:translate-x-1 smooth-transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 text-sm font-medium smooth-transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm text-sm">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 dark:border-gray-700 bg-gradient-to-b from-white to-gray-50 dark:from-gray-800 dark:to-gray-900">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block {{ request()->routeIs('dashboard') ? 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2.5 rounded-lg text-base font-medium smooth-transition">
                            <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 9l7-4"></path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('transaksi.index') }}" class="block {{ request()->routeIs('transaksi.*') ? 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2.5 rounded-lg text-base font-medium smooth-transition">
                            <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Transaksi
                        </a>
                        <a href="{{ route('laporan') }}" class="block {{ request()->routeIs('laporan') ? 'bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }} px-3 py-2.5 rounded-lg text-base font-medium smooth-transition">
                            <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Laporan
                        </a>
                        <div class="my-3 border-t border-gray-200 dark:border-gray-700"></div>
                        <div class="px-3 py-2">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Akun</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                {{ Auth::user()->name }}
                            </p>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left text-gray-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 px-3 py-2 rounded-lg text-sm font-medium smooth-transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="block text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2.5 rounded-lg text-base font-medium smooth-transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="block inline-flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm text-sm mx-2">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 alert alert-success animate-in fade-in slide-in-from-top duration-300">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Error Alert -->
        @if($errors->any())
            <div class="mb-6 alert alert-danger animate-in fade-in slide-in-from-top duration-300">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-16 bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-800 dark:to-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/logo.webp') }}" alt="Keuangan Pribadi Logo" class="h-6 w-auto rounded-lg">
                        <span class="text-lg font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">ReKa</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Aplikasi Keuangan Pribadi untuk mengelola keuangan Anda dengan mudah.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Menu</h3>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600 dark:hover:text-blue-400 smooth-transition">Dashboard</a></li>
                        <li><a href="{{ route('transaksi.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400 smooth-transition">Transaksi</a></li>
                        <li><a href="{{ route('laporan') }}" class="hover:text-blue-600 dark:hover:text-blue-400 smooth-transition">Laporan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                <p class="text-gray-600 dark:text-gray-400 text-sm text-center">
                    © {{ date('Y') }} Aplikasi Keuangan Pribadi (ReKa). Semua hak dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                
                // Animate icon
                if (isHidden) {
                    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                } else {
                    menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                }
            });
        }

        // Close menu when clicking on a link
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu a, #mobile-menu form button');
        mobileMenuLinks.forEach(element => {
            element.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('[class*="alert"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    </script>
</body>
</html>