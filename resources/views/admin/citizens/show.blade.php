@extends('layouts.admin')

@section('title', 'Citizen Profile')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.citizens.index') }}" class="text-green-700 hover:text-green-800 text-sm">&larr; Back to Citizens</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center mb-4">
            <div class="w-20 h-20 bg-green-100 rounded-full mx-auto flex items-center justify-center">
                <span class="text-2xl font-bold text-green-700">{{ substr($citizen->full_name, 0, 1) }}</span>
            </div>
            <h2 class="mt-3 text-xl font-bold text-gray-800">{{ $citizen->full_name }}</h2>
            <p class="text-gray-500 text-sm">{{ $citizen->email ?? '' }}</p>
        </div>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Phone</span>
                <span class="text-gray-800">{{ $citizen->phone ?? '' }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Date of Birth</span>
                <span class="text-gray-800">{{ $citizen->date_of_birth?->format('d M Y') ?? '' }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Gender</span>
                <span class="text-gray-800">{{ ucfirst($citizen->gender ?? '') }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Marital Status</span>
                <span class="text-gray-800">{{ ucfirst($citizen->marital_status ?? '') }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Nationality</span>
                <span class="text-gray-800">{{ $citizen->nationality ?? 'Bangladeshi' }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Area</span>
                <span class="text-gray-800">{{ $citizen->area_of_residence }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Occupation</span>
                <span class="text-gray-800">{{ $citizen->occupation?->name ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Father's Name</span>
                <span class="text-gray-800">{{ $citizen->father_name ?? '' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Address</span>
                <span class="text-gray-800 text-right max-w-[200px]">{{ $citizen->address ?? '' }}</span>
            </div>
        </div>
    </div>

    <!-- Documents -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Passport Number</span>
                <span class="text-gray-800">{{ $citizen->passport_number ?? 'N/A' }}</span>
            </div>
            @if($citizen->passport_expiry)
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Passport Expiry</span>
                <span class="text-gray-800">{{ $citizen->passport_expiry->format('d M Y') }}</span>
            </div>
            @endif
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Residence Card #</span>
                <span class="text-gray-800">{{ $citizen->residence_card_number ?? 'N/A' }}</span>
            </div>
            @if($citizen->residence_card_expiry)
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500">Residence Card Expiry</span>
                <span class="text-gray-800">{{ $citizen->residence_card_expiry->format('d M Y') }}</span>
            </div>
            @endif
        </div>

        <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4">Appointments</h3>
        <div class="space-y-3">
            @forelse($citizen->appointments->take(5) as $appointment)
                <div class="flex items-center justify-between text-sm border-b pb-2">
                    <div>
                        <p class="text-gray-700 font-medium">{{ $appointment->reference_number }}</p>
                        <p class="text-xs text-gray-400">{{ $appointment->service->name ?? 'N/A' }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' :
                           ($appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' :
                           'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">No appointments found</p>
            @endforelse
        </div>
    </div>

    <!-- Passports -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Passport Records</h3>
        @forelse($citizen->passports as $passport)
            <div class="border-b pb-3 mb-3 last:border-0 text-sm">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">{{ $passport->passport_number }}</span>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $passport->status === 'ready' ? 'bg-green-100 text-green-700' :
                           ($passport->status === 'processing' ? 'bg-blue-100 text-blue-700' :
                           'bg-yellow-100 text-yellow-700') }}">
                        {{ ucfirst($passport->status) }}
                    </span>
                </div>
                @if($passport->issue_date)
                    <p class="text-gray-400 text-xs mt-1">Issued: {{ $passport->issue_date->format('d M Y') }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-400 text-sm">No passport records</p>
        @endforelse

        <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-4">Consular Records</h3>
        @forelse($citizen->consulars as $consular)
            <div class="border-b pb-3 mb-3 last:border-0 text-sm">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-700">{{ $consular->service->name ?? 'N/A' }}</span>
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        {{ ucfirst($consular->status ?? 'pending') }}
                    </span>
                </div>
                <p class="text-gray-400 text-xs mt-1">{{ $consular->created_at->format('d M Y') }}</p>
            </div>
        @empty
            <p class="text-gray-400 text-sm">No consular records</p>
        @endforelse
    </div>
</div>
@endsection
