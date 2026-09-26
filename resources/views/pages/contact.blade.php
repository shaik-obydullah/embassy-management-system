@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Contact Us</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow p-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Send us a Message</h2>
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('subject') border-red-500 @enderror">
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" id="message" rows="5" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Address</h3>
                            <p class="text-gray-500 text-sm">Embassy of Bangladesh<br>Washington, D.C., USA</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Phone</h3>
                            <p class="text-gray-500 text-sm">+1 (202) 555-0123</p>
                            <p class="text-gray-500 text-sm">+1 (202) 555-0124 (Emergency)</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <p class="text-gray-500 text-sm">info@embassy.gov.bd</p>
                            <p class="text-gray-500 text-sm">consular@embassy.gov.bd</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Office Hours</h3>
                            <p class="text-gray-500 text-sm">Sunday - Thursday: 9:00 AM - 5:00 PM</p>
                            <p class="text-gray-500 text-sm">Friday - Saturday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
