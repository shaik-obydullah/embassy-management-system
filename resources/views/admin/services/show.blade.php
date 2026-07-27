@extends('layouts.admin')

@section('title', 'Service Details')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-green-700 hover:text-green-800">&larr; Back to Services</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-start mb-6">
            <h2 class="text-2xl font-bold text-gray-900">{{ $service->name }}</h2>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                @if($service->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                {{ $service->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Slug</label>
                <p class="mt-1 text-sm text-gray-900">{{ $service->slug }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Fee</label>
                <p class="mt-1 text-sm text-gray-900">${{ number_format($service->fee, 2) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Category</label>
                <p class="mt-1 text-sm text-gray-900">{{ $service->category ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500">Estimated Days</label>
                <p class="mt-1 text-sm text-gray-900">{{ $service->estimated_days ?? 'N/A' }}</p>
            </div>
            @if($service->description)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Description</label>
                <p class="mt-1 text-sm text-gray-900">{{ $service->description }}</p>
            </div>
            @endif
            @if($service->required_documents && count($service->required_documents) > 0)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500">Required Documents</label>
                <ul class="mt-1 text-sm text-gray-900 list-disc list-inside">
                    @foreach($service->required_documents as $doc)
                    <li>{{ $doc }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('admin.services.edit', $service) }}" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-md text-sm font-medium">Edit</a>
            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection