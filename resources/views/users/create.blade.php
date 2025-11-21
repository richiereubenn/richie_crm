@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">
        {{ isset($user) ? 'Edit User' : 'Create User' }}
    </h2>

    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST"
        class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-sm">Username</label>
            <input name="username" class="w-full border px-3 py-2" value="{{ old('username', $user->username ?? '') }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm">
                Password {{ isset($user) ? '(kosongkan jika tidak berubah)' : '' }}
            </label>
            <input type="password" name="password" class="w-full border px-3 py-2" {{ isset($user) ? '' : 'required' }}>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Role</label>
            <select name="role" class="w-full border px-3 py-2">
                @php
                    $roles = ['Admin', 'Manager', 'Sales'];
                @endphp
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ (old('role', $user->role ?? '') === $role) ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <strong>Oops! Something went wrong:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div>
            <button class="bg-green-600 px-6 py-2 rounded text-white">Save</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-red-600">Cancel</a>
        </div>
    </form>
@endsection