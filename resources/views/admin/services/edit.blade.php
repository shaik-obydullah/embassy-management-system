@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.services.index') }}" class="text-green-700 hover:text-green-800 text-sm">&larr; Back to Services</a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Service</h1>

    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('slug') border-red-500 @enderror">
            @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="fee" class="block text-sm font-medium text-gray-700 mb-1">Fee ($)</label>
                <input type="number" step="0.01" name="fee" id="fee" value="{{ old('fee', $service->fee) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('fee') border-red-500 @enderror">
                @error('fee')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" id="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="passport" {{ old('category', $service->category) === 'passport' ? 'selected' : '' }}>Passport</option>
                    <option value="consular" {{ old('category', $service->category) === 'consular' ? 'selected' : '' }}>Consular</option>
                    <option value="visa" {{ old('category', $service->category) === 'visa' ? 'selected' : '' }}>Visa</option>
                    <option value="legal" {{ old('category', $service->category) === 'legal' ? 'selected' : '' }}>Legal</option>
                    <option value="other" {{ old('category', $service->category) === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="required_documents" class="block text-sm font-medium text-gray-700 mb-1">Required Documents (one per line)</label>
            <textarea name="required_documents" id="required_documents" rows="3"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('required_documents') border-red-500 @enderror">{{ old('required_documents', is_array($service->required_documents) ? implode("\n", $service->required_documents) : $service->required_documents) }}</textarea>
            @error('required_documents')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="estimated_days" class="block text-sm font-medium text-gray-700 mb-1">Estimated Days</label>
                <input type="number" name="estimated_days" id="estimated_days" value="{{ old('estimated_days', $service->estimated_days) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('estimated_days') border-red-500 @enderror">
                @error('estimated_days')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-md hover:bg-green-800 transition font-medium">
            Update Service
        </button>
    </form>
</div>
@endsection
