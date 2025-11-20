@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Create Project</h2>

    <form action="{{ route('projects.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-sm">Select Lead</label>
            <select name="lead_id" class="w-full border px-3 py-2" required>
                <option value="">-- select lead --</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}">{{ $lead->name }} — {{ $lead->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Select Product</label>
            <select name="product_id" class="w-full border px-3 py-2" required>
                <option value="">-- select product --</option>
                @foreach($products as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->name }} — Rp {{ number_format($prod->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
            <a href="{{ route('projects.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection