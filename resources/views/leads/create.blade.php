@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">
    {{ isset($lead) ? 'Edit Lead' : 'Create Lead' }}
</h2>

<form 
    action="{{ isset($lead) ? route('leads.update', $lead) : route('leads.store') }}" 
    method="POST" 
    class="bg-white p-6 rounded shadow"
>
    @csrf
    @if(isset($lead))
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block text-sm">Name</label>
        <input 
            name="name" 
            class="w-full border px-3 py-2" 
            value="{{ old('name', $lead->name ?? '') }}" 
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-sm">Email</label>
        <input 
            name="email" 
            class="w-full border px-3 py-2" 
            value="{{ old('email', $lead->email ?? '') }}" 
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-sm">Phone</label>
        <input 
            name="phone" 
            class="w-full border px-3 py-2" 
            value="{{ old('phone', $lead->phone ?? '') }}" 
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-sm">Address</label>
        <input 
            name="address" 
            class="w-full border px-3 py-2" 
            value="{{ old('address', $lead->address ?? '') }}" 
            required
        >
    </div>

    <div>
        <button class="bg-green-600 px-6 py-2 rounded text-white">
            {{ isset($lead) ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('leads.index') }}" class="ml-2 text-red-600">Cancel</a>
    </div>
</form>
@endsection
