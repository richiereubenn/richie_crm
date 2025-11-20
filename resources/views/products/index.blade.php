@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold">Products</h2>
  <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add Product</a>
</div>

<div class="bg-white shadow rounded">
  <table class="min-w-full">
    <thead>
      <tr class="border-b">
        <th class="p-3">#</th>
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
        <td class="p-3">Rp {{ number_format($p->price,0,',','.') }}</td>
        <td class="p-3">{{ $p->subscription_period }}</td>
        <td class="p-3 flex gap-2 justify-center">
          <a href="{{ route('products.edit', $p) }}" class="text-blue-600">Edit</a>
          <form action="{{ route('products.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete product?')">
            @csrf @method('DELETE')
            <button class="text-red-600">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
