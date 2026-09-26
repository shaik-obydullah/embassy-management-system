@extends('layouts.client')

@section('title', 'New Appointment')

@section('content')
<div class="mb-6">
    <a href="{{ route('client.appointments.index') }}" class="text-green-700 hover:text-green-800 text-sm">&larr; Back to Appointments</a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Book New Appointment</h1>

    <form method="POST" action="{{ route('client.appointments.store') }}" x-data="{ step: 1 }">
        @csrf

        <!-- Step 1: Select Service -->
        <div x-show="step === 1">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Step 1: Select Service</h2>
            <div class="mb-4">
                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                <select name="service_id" id="service_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('service_id') border-red-500 @enderror">
                    <option value="">Choose a service...</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - ${{ number_format($service->fee, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="button" @click="step = 2" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                Next
            </button>
        </div>

        <!-- Step 2: Select Slot -->
        <div x-show="step === 2">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Step 2: Select Date & Time</h2>
            <div class="mb-4">
                <label for="slot_id" class="block text-sm font-medium text-gray-700 mb-1">Available Slot</label>
                @if($slots->count())
                <select name="slot_id" id="slot_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('slot_id') border-red-500 @enderror">
                    <option value="">Choose a time slot...</option>
                    @foreach($slots as $slot)
                        <option value="{{ $slot->id }}" {{ old('slot_id') == $slot->id ? 'selected' : '' }}>
                            {{ $slot->date->format('l, M d, Y') }} &mdash; {{ $slot->start_time->format('g:i A') }} to {{ $slot->end_time->format('g:i A') }}
                        </option>
                    @endforeach
                </select>
                @else
                <p class="text-gray-500 text-sm">No available time slots at this time. Please check back later.</p>
                @endif
                @error('slot_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-3">
                <button type="button" @click="step = 1" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                    Back
                </button>
                <button type="button" @click="step = 3" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">
                    Next
                </button>
            </div>
        </div>

        <!-- Step 3: Confirm -->
        <div x-show="step === 3">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Step 3: Confirm & Submit</h2>
            <p class="text-gray-500 text-sm mb-4">Please review your appointment details before submitting.</p>
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('notes') }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" @click="step = 2" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">
                    Back
                </button>
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-md hover:bg-green-800 transition font-medium">
                    Confirm Appointment
                </button>
            </div>
        </div>
    </form>
</div>
@endsection