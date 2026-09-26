<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Portal') - Embassy Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 antialiased" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0 lg:w-64'"
               class="fixed inset-y-0 left-0 z-30 w-64 bg-green-800 transform transition-transform duration-200 ease-in-out lg:static lg:translate-x-0">
            <div class="flex items-center justify-center h-16 bg-green-700">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                </svg>
                <span class="ml-2 text-white font-bold">My Portal</span>
            </div>
            <nav class="mt-5 px-3 space-y-1">
                <a href="{{ route('client.dashboard') }}" class="flex items-center px-3 py-2 text-green-100 hover:bg-green-700 rounded-md {{ request()->routeIs('client.dashboard') ? 'bg-green-700' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('client.profile.show') }}" class="flex items-center px-3 py-2 text-green-100 hover:bg-green-700 rounded-md {{ request()->routeIs('client.profile.*') ? 'bg-green-700' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    My Profile
                </a>
                <a href="{{ route('client.appointments.index') }}" class="flex items-center px-3 py-2 text-green-100 hover:bg-green-700 rounded-md {{ request()->routeIs('client.appointments.*') ? 'bg-green-700' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    My Appointments
                </a>
                <a href="{{ route('client.services.index') }}" class="flex items-center px-3 py-2 text-green-100 hover:bg-green-700 rounded-md {{ request()->routeIs('client.services.*') ? 'bg-green-700' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    My Services
                </a>
                <a href="{{ route('client.appointments.create') }}" class="flex items-center px-3 py-2 text-green-100 hover:bg-green-700 rounded-md {{ request()->routeIs('client.appointments.create') ? 'bg-green-700' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    New Appointment
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex items-center space-x-4 ml-auto">
                    <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 p-4 lg:p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
