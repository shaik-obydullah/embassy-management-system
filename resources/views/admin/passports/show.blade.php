@extends('layouts.admin')

@section('title', 'Passport Details')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.passports.index') }}" class="text-green-700 hover:text-green-800">&larr; Back to Passports</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Passport Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Passport Number</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->passport_number }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($passport->status === 'ready') bg-green-100 text-green-800
                    @elseif($passport->status === 'processing') bg-blue-100 text-blue-800
                    @elseif($passport->status === 'rejected') bg-red-100 text-red-800
                    @elseif($passport->status === 'delivered') bg-purple-100 text-purple-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($passport->status) }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Citizen</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->citizen->full_name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Created By</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->user->name ?? 'N/A' }}</p>
            </div>
            @if($passport->issue_date)
            <div>
                <label class="block text-sm font-medium text-gray-500">Issue Date</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->issue_date->format('M d, Y') }}</p>
            </div>
            @endif
            @if($passport->expiry_date)
            <div>
                <label class="block text-sm font-medium text-gray-500">Expiry Date</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->expiry_date->format('M d, Y') }}</p>
            </div>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-500">Created At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $passport->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.passports.update-status', $passport) }}">
                @csrf
                @method('PATCH')
                <div class="flex items-center space-x-4">
                    <select name="status" class="border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="pending" {{ $passport->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $passport->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="ready" {{ $passport->status === 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="delivered" {{ $passport->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="rejected" {{ $passport->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md text-sm font-medium">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection