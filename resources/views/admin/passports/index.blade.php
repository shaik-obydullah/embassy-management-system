@extends('layouts.admin')

@section('title', 'Passports')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Passport Applications</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Citizen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applied Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($passports ?? [] as $passport)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $passport->reference_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $passport->citizen->full_name ?? '' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($passport->type) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                                'completed' => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$passport->status] ?? '' }}">
                            {{ ucfirst($passport->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $passport->created_at?->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.passports.show', $passport) }}" class="text-green-600 hover:text-green-800 mr-3">View</a>
                        <div x-data="{ open: false }" class="inline-block">
                            <button @click="open = !open" class="text-blue-600 hover:text-blue-800">Update Status</button>
                            <div x-show="open" @click.away="open = false" x-transition
                                 class="absolute mt-2 bg-white border rounded-lg shadow-lg p-3 z-10">
                                <form method="POST" action="{{ route('admin.passports.update-status', $passport) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="block w-full mb-2 px-2 py-1 border rounded text-sm">
                                        <option value="pending" {{ $passport->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $passport->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="approved" {{ $passport->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $passport->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="completed" {{ $passport->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <button type="submit" class="w-full bg-green-700 text-white px-3 py-1 rounded text-sm hover:bg-green-800">Save</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No passport applications found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3">
        {!! $passports->links() !!}
    </div>
</div>
@endsection
