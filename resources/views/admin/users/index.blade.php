@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($users ?? [] as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php $userRoles = $user->getRoleNames(); @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $userRoles->contains('superadmin') || $userRoles->contains('admin') ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $userRoles->implode(', ') ?: 'No Role' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at?->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-3">
        {!! $users->links() !!}
    </div>
</div>
@endsection
