@extends('layouts.client')

@section('title', 'My Profile')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Profile Information</h2>
        <a href="{{ route('client.profile.edit') }}" class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 transition text-sm font-medium">
            Edit Profile
        </a>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-500">Full Name</label>
                <p class="text-gray-800 font-medium">{{ $citizen->full_name ?? '' }}</p>
            </div>
            <div>
                <label class="block text-sm text-gray-500">Email</label>
                <p class="text-gray-800 font-medium">{{ $citizen->email ?? '' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-500">Phone</label>
                <p class="text-gray-800 font-medium">{{ $citizen->phone ?? '' }}</p>
            </div>
            <div>
                <label class="block text-sm text-gray-500">Nationality</label>
                <p class="text-gray-800 font-medium">{{ $citizen->nationality ?? '' }}</p>
            </div>
        </div>

        <div>
            <label class="block text-sm text-gray-500">Address</label>
            <p class="text-gray-800 font-medium">{{ $citizen->address ?? '' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-500">Date of Birth</label>
                <p class="text-gray-800 font-medium">{{ $citizen->date_of_birth?->format('d M Y') ?? '' }}</p>
            </div>
            <div>
                <label class="block text-sm text-gray-500">Passport Number</label>
                <p class="text-gray-800 font-medium">{{ $citizen->passport_number ?? '' }}</p>
            </div>
        </div>

        <div>
            <label class="block text-sm text-gray-500">Area of Residence</label>
            <p class="text-gray-800 font-medium">{{ $citizen->area_of_residence ?? '' }}</p>
        </div>
    </div>
</div>
@endsection
