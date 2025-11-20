@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Products</h2>
        @if(auth()->user()->role === 'Admin')
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
        @endif
    </div>

    <div class="bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Subscription (days)</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr class="border-b">
                        <td class="p-3">{{ $p->id }}</td>
                        <td class="p-3">{{ $p->name }}</td>
                        <td class="p-3">{{ $p->description }}</td>
                        <td class="p-3">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $p->subscription_period }}</td>
                        <td class="p-3 flex gap-2 justify-center">
                            @if(auth()->user()->role === 'Admin')
                                <a href="{{ route('products.edit', $p) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('products.destroy', $p) }}" method="POST"
                                    onsubmit="return confirm('Are you sure? This action will permanently delete the product')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600">Delete</button>
                                </form>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection