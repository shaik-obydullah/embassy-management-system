@extends('layouts.client')

@section('title', 'Edit Profile')

@section('content')
<div class="mb-6">
    <a href="{{ route('client.profile.show') }}" class="text-green-700 hover:text-green-800 text-sm">&larr; Back to Profile</a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>

    <form method="POST" action="{{ route('client.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $citizen->first_name ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('first_name') border-red-500 @enderror">
                @error('first_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $citizen->last_name ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('last_name') border-red-500 @enderror">
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $citizen->phone ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="nationality" class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                <input type="text" name="nationality" id="nationality" value="{{ old('nationality', $citizen->nationality ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('nationality') border-red-500 @enderror">
                @error('nationality')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="address" id="address" rows="2"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('address') border-red-500 @enderror">{{ old('address', $citizen->address ?? '') }}</textarea>
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $citizen->date_of_birth?->format('Y-m-d') ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('date_of_birth') border-red-500 @enderror">
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="passport_number" class="block text-sm font-medium text-gray-700 mb-1">Passport Number</label>
                <input type="text" name="passport_number" id="passport_number" value="{{ old('passport_number', $citizen->passport_number ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('passport_number') border-red-500 @enderror">
                @error('passport_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" id="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $citizen->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $citizen->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $citizen->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-1">Marital Status</label>
                <select name="marital_status" id="marital_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">Select</option>
                    <option value="single" {{ old('marital_status', $citizen->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="married" {{ old('marital_status', $citizen->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                    <option value="divorced" {{ old('marital_status', $citizen->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="widowed" {{ old('marital_status', $citizen->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="father_name" class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                <input type="text" name="father_name" id="father_name" value="{{ old('father_name', $citizen->father_name ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $citizen->mother_name ?? '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="area_id" class="block text-sm font-medium text-gray-700 mb-1">Area / District</label>
                <select name="area_id" id="area_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">Select Area</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id', $citizen->area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="occupation_id" class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                <select name="occupation_id" id="occupation_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">Select Occupation</option>
                    @foreach($occupations as $occupation)
                        <option value="{{ $occupation->id }}" {{ old('occupation_id', $citizen->occupation_id) == $occupation->id ? 'selected' : '' }}>{{ $occupation->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-md hover:bg-green-800 transition font-medium">
            Update Profile
        </button>
    </form>
</div>
@endsection
