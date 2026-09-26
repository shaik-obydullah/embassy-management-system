@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-green-700 hover:text-green-800">&larr; Back to Users</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit User: {{ $user->name }}</h2>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select id="role" name="role"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                    required>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-md text-sm font-medium">
                    Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection