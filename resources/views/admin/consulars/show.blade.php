@extends('layouts.admin')

@section('title', 'Consular Record Details')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.consulars.index') }}" class="text-green-700 hover:text-green-800">&larr; Back to Consular Records</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Consular Record Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Record ID</label>
                <p class="mt-1 text-sm text-gray-900">#{{ $consular->id }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    {{ ucfirst($consular->status ?? 'pending') }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Citizen</label>
                <p class="mt-1 text-sm text-gray-900">{{ $consular->citizen->full_name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Service</label>
                <p class="mt-1 text-sm text-gray-900">{{ $consular->service->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Processed By</label>
                <p class="mt-1 text-sm text-gray-900">{{ $consular->user->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Created At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $consular->created_at->format('M d, Y H:i') }}</p>
            </div>
            @if($consular->notes)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Notes</label>
                <p class="mt-1 text-sm text-gray-900">{{ $consular->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection