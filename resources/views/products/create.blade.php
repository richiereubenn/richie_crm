@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">
    {{ isset($product) ? 'Edit Product' : 'Tambah Product' }}
</h2>

<form 
    action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" 
    method="POST" 
    class="bg-white p-6 rounded shadow"
>
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block text-sm">Name</label>
        <input 
            name="name" 
            class="w-full border px-3 py-2" 
            value="{{ old('name', $product->name ?? '') }}" 
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-sm">Description</label>
        <textarea 
            name="description" 
            class="w-full border px-3 py-2"
        >{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block text-sm">Price (int)</label>
        <input 
            name="price" 
            type="number" 
            class="w-full border px-3 py-2" 
            value="{{ old('price', $product->price ?? '') }}" 
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-sm">Subscription Period (days)</label>
        <input 
            name="subscription_period" 
            type="number" 
            class="w-full border px-3 py-2" 
            value="{{ old('subscription_period', $product->subscription_period ?? '') }}" 
            required
        >
    </div>

    <div>
        <button class="bg-green-600 px-6 py-2 rounded text-white">
            {{ isset($product) ? 'Update' : 'Save' }}
        </button>
        <a href="{{ route('products.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </div>
</form>
@endsection
