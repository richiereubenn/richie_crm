@extends('layouts.app')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Manage Users</h2>
    <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add User</a>
  </div>

  <div class="bg-white shadow rounded">
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
        @foreach($users as $u)
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
        @endforeach
      </tbody>
    </table>
  </div>
@endsection