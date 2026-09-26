@extends('layouts.admin')

@section('title', 'Consular Services')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Consular Services</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Citizen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($consulars ?? [] as $consular)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $consular->reference_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $consular->citizen->full_name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $consular->service->name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'in_progress' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$consular->status] ?? '' }}">
                            {{ ucfirst(str_replace('_', ' ', $consular->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.consulars.show', $consular) }}" class="text-green-600 hover:text-green-800">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No consular records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3">
        {!! $consulars->links() !!}
    </div>
</div>
@endsection
