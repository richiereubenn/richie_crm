@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Create Project</h2>

    <form action="{{ route('projects.store') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf

        <div class="mb-4">
            <label class="block text-sm">Select Lead</label>
            <select name="lead_id" class="w-full border px-3 py-2">
                <option value="">-- select lead --</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}">{{ $lead->name }} — {{ $lead->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Select Product</label>
            <select name="product_id" class="w-full border px-3 py-2">
                <option value="">-- select product --</option>
                @foreach($products as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->name }} — Rp {{ number_format($prod->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <strong>Oops! Ada yang salah:</strong>
                <p>halo</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
            <a href="{{ route('projects.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection