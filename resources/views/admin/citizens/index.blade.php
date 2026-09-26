@extends('layouts.admin')

@section('title', 'Citizens')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Citizens</h1>
    <a href="{{ route('admin.citizens.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition text-sm font-medium">
        + Add Citizen
    </a>
</div>

<!-- Search -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.citizens.index') }}">
        <div class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, passport, phone..."
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition">Search</button>
        </div>
    </form>
</div>

<!-- Citizens Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passport #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Area</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($citizens ?? [] as $citizen)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $citizen->full_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $citizen->passport_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $citizen->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $citizen->area_of_residence }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.citizens.show', $citizen) }}" class="text-green-600 hover:text-green-800 mr-3">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No citizens found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3">
        {!! $citizens->links() !!}
    </div>
</div>
@endsection
