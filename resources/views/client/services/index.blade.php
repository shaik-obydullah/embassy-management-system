@extends('layouts.client')

@section('title', 'Available Services')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Available Services</h1>
    <p class="text-gray-500 text-sm mt-1">Browse all embassy services and their fees</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($services ?? [] as $service)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">{{ ucfirst($service->category) }}</span>
                <span class="text-lg font-bold text-green-700">${{ number_format($service->fee, 2) }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $service->name }}</h3>
            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($service->description, 100) }}</p>
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-400">Est. {{ $service->estimated_days ?? 7 }} days</span>
                <a href="{{ route('client.appointments.create') }}" class="text-green-700 hover:text-green-800 text-sm font-medium">Book &rarr;</a>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-400">No services available at the moment</p>
        </div>
    @endforelse
</div>
@endsection
