@extends('layouts.app')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Manage Users</h2>
    <a href="{{ route('users.create') }}"
      class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add User
    </a>
  </div>

  <div class="bg-white shadow-md rounded-lg">
    <table class="min-w-full">
      <thead>
        <tr class="border-b">
          <th class="p-3 text-left">#</th>
          <th class="p-3 text-left">Username</th>
          <th class="p-3 text-left">Role</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
          <tr class="border-b">
            <td class="p-3">{{ $u->id }}</td>
            <td class="p-3">{{ $u->username }}</td>
            <td class="p-3">{{ $u->role }}</td>
            <td class="p-3 flex gap-2 justify-center">
              <a href="{{ route('users.edit', $u) }}" class="text-blue-600">Edit</a>

              <form action="{{ route('users.destroy', $u) }}" method="POST"
                onsubmit="return confirm('Are you sure? This action will permanently delete the user.')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center p-4 text-gray-500">
              No users available yet.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection