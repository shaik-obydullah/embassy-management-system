<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Embassy Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <nav x-data="{ mobileOpen: false }" class="bg-green-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        <span class="text-white font-bold text-lg">Embassy Management</span>
                    </a>
                    <div class="hidden md:flex md:ml-10 md:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-green-100 hover:text-white transition">Home</a>
                        <a href="{{ route('pages.services') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-green-100 hover:text-white transition">Services</a>
                        @auth
                            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-green-100 hover:text-white transition">Appointments</a>
                        @endauth
                    </div>
                </div>
                <div class="hidden md:flex md:items-center md:space-x-4">
                    @auth
                        <span class="text-green-100 text-sm">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-green-100 hover:text-white text-sm">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-green-100 hover:text-white text-sm">Logout</button>
                        </form>
                    @else
                        @if(Route::has('login'))
                            <a href="{{ route('login') }}" class="text-green-100 hover:text-white text-sm">Login</a>
                        @endif
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-white text-green-800 px-4 py-2 rounded-md text-sm font-medium hover:bg-green-50 transition">Register</a>
                        @endif
                    @endauth
                </div>
                <div class="flex items-center md:hidden">
                    <button @click="mobileOpen = !mobileOpen" class="text-green-100 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div x-show="mobileOpen" x-transition class="md:hidden bg-green-900">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-green-100 hover:text-white">Home</a>
                <a href="{{ route('pages.services') }}" class="block px-3 py-2 text-green-100 hover:text-white">Services</a>
                @auth
                    <a href="{{ route('client.dashboard') }}" class="block px-3 py-2 text-green-100 hover:text-white">Appointments</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-green-100 hover:text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-green-100 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-green-100 hover:text-white">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-green-900 text-green-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-sm">&copy; {{ date('Y') }} Bangladesh Embassy Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
