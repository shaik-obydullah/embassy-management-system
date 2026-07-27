@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.appointments.index') }}" class="text-green-700 hover:text-green-800">&larr; Back to Appointments</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Appointment Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Appointment ID</label>
                <p class="mt-1 text-sm text-gray-900">#{{ $appointment->id }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                    @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Citizen</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->citizen->full_name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Service</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->service->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Slot</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->slot->date?->format('d M Y') ?? 'N/A' }} {{ $appointment->slot->start_time?->format('g:i A') ?? '' }} - {{ $appointment->slot->end_time?->format('g:i A') ?? '' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Created By</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->user->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Created At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->created_at->format('M d, Y H:i') }}</p>
            </div>
            @if($appointment->notes)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Notes</label>
                <p class="mt-1 text-sm text-gray-900">{{ $appointment->notes }}</p>
            </div>
            @endif
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.appointments.status', $appointment) }}">
                @csrf
                @method('PATCH')
                <div class="flex items-center space-x-4">
                    <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md text-sm font-medium">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection