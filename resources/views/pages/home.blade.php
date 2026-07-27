@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="bg-green-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to Bangladesh Embassy Management System</h1>
        <p class="text-xl text-green-100 mb-8 max-w-3xl mx-auto">
            Your one-stop portal for all embassy services, appointments, and consular assistance.
        </p>
        <div class="flex justify-center gap-4">
            @auth
                <a href="{{ route('client.dashboard') }}" class="bg-white text-green-800 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-white text-green-800 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Passport Services</h3>
                <p class="text-gray-500">Apply for new passports, renewals, and lost passport replacements.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Consular Services</h3>
                <p class="text-gray-500">Document attestation, power of attorney, and other legal services.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Online Appointments</h3>
                <p class="text-gray-500">Book appointments online and skip the queue.</p>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('pages.services') }}" class="text-green-700 hover:text-green-800 font-medium">View All Services &rarr;</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">About the Embassy</h2>
                <p class="text-gray-600 mb-4">
                    The Embassy of Bangladesh is committed to providing efficient and transparent consular services
                    to Bangladeshi nationals and the broader community.
                </p>
                <p class="text-gray-600 mb-6">
                    Our digital management system ensures quick processing, real-time tracking, and seamless
                    communication between citizens and embassy officials.
                </p>
                <a href="{{ route('about') }}" class="text-green-700 hover:text-green-800 font-medium">Learn More &rarr;</a>
            </div>
            <div class="bg-green-100 rounded-lg p-8 text-center">
                <div class="text-6xl font-bold text-green-700 mb-2">24/7</div>
                <p class="text-gray-600">Online Portal Access</p>
                <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-green-700">50+</div>
                        <p class="text-gray-500 text-sm">Services</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-700">10K+</div>
                        <p class="text-gray-500 text-sm">Citizens Served</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Contact Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div>
                <div class="w-12 h-12 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-3">
                    <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Address</h3>
                <p class="text-gray-500 text-sm">Embassy of Bangladesh</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-3">
                    <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Phone</h3>
                <p class="text-gray-500 text-sm">+1 (202) 555-0123</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-3">
                    <svg class="h-6 w-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Email</h3>
                <p class="text-gray-500 text-sm">info@embassy.gov.bd</p>
            </div>
        </div>
    </div>
</section>
@endsection
