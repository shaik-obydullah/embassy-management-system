@extends('layouts.app')

@section('title', 'Services')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 text-center">Our Services</h1>
        <p class="text-gray-500 text-center mb-12">Browse all available embassy services</p>

        @php
            $groupedServices = $services->groupBy('category');
        @endphp

        @foreach($groupedServices as $category => $categoryServices)
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-green-800 mb-6 capitalize">{{ $category }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryServices as $service)
                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $service->name }}</h3>
                                <span class="text-lg font-bold text-green-700">${{ number_format($service->fee, 2) }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mb-4">{{ $service->description }}</p>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Est. {{ $service->estimated_days ?? 7 }} days</span>
                                @auth
                                    <a href="{{ route('client.appointments.create') }}" class="text-green-700 hover:text-green-800 font-medium">Book Now &rarr;</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-green-700 hover:text-green-800 font-medium">Login to Book &rarr;</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if(!isset($services) || $services->isEmpty())
            <p class="text-gray-400 text-center py-12">No services available at the moment</p>
        @endif
    </div>
</section>
@endsection
