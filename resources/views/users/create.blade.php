@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah User</h2>

<form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow">
  @csrf
  <div class="mb-4">
    <label class="block text-sm">Username</label>
    <input name="username" class="w-full border px-3 py-2" value="{{ old('username') }}" required>
  </div>

  <div class="mb-4">
    <label class="block text-sm">Password</label>
    <input type="password" name="password" class="w-full border px-3 py-2" required>
  </div>

  <div class="mb-4">
    <label class="block text-sm">Role</label>
    <select name="role" class="w-full border px-3 py-2" required>
      <option value="">-- pilih role --</option>
      <option value="Admin">Admin</option>
      <option value="Manager">Manager</option>
      <option value="Sales">Sales</option>
    </select>
  </div>

  <div>
    <button class="bg-green-600 px-6 py-2 rounded text-white">Save</button>
    <a href="{{ route('users.index') }}" class="ml-2 text-red-600">Cancel</a>
  </div>
</form>
@endsection
