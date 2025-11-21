@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">
        {{ isset($product) ? 'Edit Product' : 'Create Product' }}
    </h2>

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST"
        class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-sm">Name</label>
            <input name="name" class="w-full border px-3 py-2" value="{{ old('name', $product->name ?? '') }}" >
        </div>

        <div class="mb-4">
            <label class="block text-sm">Description</label>
            <textarea name="description"
                class="w-full border px-3 py-2">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Price</label>
            <input name="price" type="number" class="w-full border px-3 py-2"
                value="{{ old('price', $product->price ?? '') }}" >
        </div>

        <div class="mb-4">
            <label class="block text-sm">Subscription Period (days)</label>
            <input name="subscription_period" type="number" class="w-full border px-3 py-2"
                value="{{ old('subscription_period', $product->subscription_period ?? '') }}" >
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
            <button class="bg-green-600 px-6 py-2 rounded text-white">
                {{ isset($product) ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('products.index') }}" class="ml-2 text-red-600">Cancel</a>
        </div>
    </form>
@endsection