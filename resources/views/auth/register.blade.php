@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create Account</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 @error('password') border-red-500 @enderror">
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
    </div>

    <button type="submit" class="w-full bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-800 transition font-medium">
        Register
    </button>

    <p class="mt-4 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-green-700 hover:text-green-800 font-medium">Login</a>
    </p>
</form>
@endsection
