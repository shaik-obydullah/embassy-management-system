@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Reports</h1>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-sm text-gray-500 mb-1">Total Citizens</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalCitizens ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-sm text-gray-500 mb-1">Total Appointments</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalAppointments ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-sm text-gray-500 mb-1">Total Passports</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalPassports ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-sm text-gray-500 mb-1">Total Consular Records</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalConsulars ?? 0 }}</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Appointments by Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Appointments by Status</h2>
        @if($appointmentsByStatus->isEmpty())
            <p class="text-gray-400 text-sm text-center py-4">No appointment data</p>
        @else
            <div class="space-y-3">
                @php $maxAppt = $appointmentsByStatus->max('count') ?: 1; @endphp
                @foreach($appointmentsByStatus as $item)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 capitalize">{{ $item->status }}</span>
                            <span class="text-gray-500">{{ $item->count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($item->count / $maxAppt) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Passports by Status -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Passports by Status</h2>
        @if($passportsByStatus->isEmpty())
            <p class="text-gray-400 text-sm text-center py-4">No passport data</p>
        @else
            <div class="space-y-3">
                @php $maxPass = $passportsByStatus->max('count') ?: 1; @endphp
                @foreach($passportsByStatus as $item)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 capitalize">{{ $item->status }}</span>
                            <span class="text-gray-500">{{ $item->count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($item->count / $maxPass) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Monthly Appointments -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Appointments (Last 12 Months)</h2>
    @if($monthlyAppointments->isEmpty())
        <p class="text-gray-400 text-sm text-center py-4">No monthly data</p>
    @else
        <div class="space-y-3">
            @php $maxMonthly = $monthlyAppointments->max('count') ?: 1; @endphp
            @foreach($monthlyAppointments as $item)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-700">{{ \Carbon\Carbon::createFromDate($item->year, $item->month)->format('M Y') }}</span>
                        <span class="text-gray-500">{{ $item->count }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($item->count / $maxMonthly) * 100 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Citizens by Area -->
@if(isset($citizensByArea) && $citizensByArea->isNotEmpty())
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Citizens by Area</h2>
    <div class="space-y-3">
        @php $maxArea = $citizensByArea->max('count') ?: 1; @endphp
        @foreach($citizensByArea as $item)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-700">{{ $item->area->name ?? 'Unknown' }}</span>
                    <span class="text-gray-500">{{ $item->count }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($item->count / $maxArea) * 100 }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection
