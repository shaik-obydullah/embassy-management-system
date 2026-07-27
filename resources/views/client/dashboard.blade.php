@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
    <p class="text-gray-500 text-sm mt-1">Here's your portal overview</p>
</div>

<!-- Quick Book Button -->
<div class="mb-8">
    <a href="{{ route('client.appointments.create') }}" class="inline-flex items-center bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Book New Appointment
    </a>
</div>

<!-- My Appointments Summary -->
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">My Appointments</h2>

    @forelse($appointments ?? [] as $appointment)
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg mb-3">
            <div>
                <p class="font-medium text-gray-800">{{ $appointment->service->name ?? '' }}</p>
                <p class="text-sm text-gray-500">{{ $appointment->slot->date?->format('d M Y') ?? '' }} {{ $appointment->slot->start_time?->format('g:i A') ?? '' }}</p>
                <p class="text-xs text-gray-400">Ref: {{ $appointment->reference_number }}</p>
            </div>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-700',
                    'confirmed' => 'bg-blue-100 text-blue-700',
                    'completed' => 'bg-green-100 text-green-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                ];
            @endphp
            <span class="px-3 py-1 text-xs rounded-full {{ $statusColors[$appointment->status] ?? '' }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
    @empty
        <p class="text-gray-400 text-sm text-center py-4">No appointments yet. Book your first appointment!</p>
    @endforelse

    @if(isset($appointments) && $appointments->count() > 0)
        <a href="{{ route('client.appointments.index') }}" class="text-green-700 hover:text-green-800 text-sm font-medium">View All &rarr;</a>
    @endif
</div>
@endsection
