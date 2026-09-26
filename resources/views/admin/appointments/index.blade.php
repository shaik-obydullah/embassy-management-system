@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Appointments</h1>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.appointments.index') }}">
        <div class="flex flex-wrap gap-4">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-green-500">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                       class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                       class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-green-500">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-md text-sm hover:bg-green-800 transition">Filter</button>
            </div>
        </div>
    </form>
</div>

<!-- Appointments Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Citizen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($appointments ?? [] as $appointment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $appointment->reference_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->citizen->full_name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->service->name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->slot->date?->format('d M Y') ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->slot->start_time?->format('g:i A') ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'confirmed' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$appointment->status] ?? '' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-green-600 hover:text-green-800">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No appointments found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3">
        {!! $appointments->links() !!}
    </div>
</div>
@endsection
