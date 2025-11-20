@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Customer Detail</h2>
    <a href="{{ route('customers.index') }}" class="text-gray-600">Back</a>
</div>

{{-- Lead Info --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <h3 class="text-lg font-medium mb-3">Lead Info</h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div><strong>Name:</strong> {{ $lead->name }}</div>
        <div><strong>Email:</strong> {{ $lead->email }}</div>
        <div><strong>Phone:</strong> {{ $lead->phone }}</div>
        <div><strong>Address:</strong> {{ $lead->address }}</div>
    </div>
</div>

{{-- Product List --}}
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-medium mb-4">Purchased Products</h3>

    @foreach($projects as $p)
    <div class="border rounded p-4 mb-4">
        <div class="flex justify-between items-center">

            <div>
                <div class="font-semibold">{{ $p->product->name }}</div>
                <div class="text-sm text-gray-600">{{ $p->product->description }}</div>
                <div class="text-sm text-gray-600 mt-1">
                    Price: Rp {{ number_format($p->product->price,0,',','.') }}
                </div>
            </div>

            @php $c = $p->customer; @endphp

            <div class="text-right">
                @if($c)
                    <div class="mb-2">
                        Payment: <span class="font-semibold capitalize">{{ $c->payment_status }}</span>
                    </div>
                    <div class="mb-2">Payment date: {{ $c->payment_date ? $c->payment_date->format('Y-m-d') : '-' }}</div>
                    <div class="mb-2">Expired date: {{ $c->expired_date ? $c->expired_date->format('Y-m-d') : '-' }}</div>

                    {{-- Toggle Paid/Unpaid --}}
                    @if(auth()->user()->role === 'Sales')
                    <form action="{{ route('customers.toggle-pay', $c) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <label class="inline-flex items-center cursor-pointer select-none">
                            <span class="mr-2 text-sm font-medium">{{ ucfirst($c->payment_status) }}</span>
                            <div class="relative">
                                <input type="checkbox" class="sr-only" {{ $c->payment_status === 'paid' ? 'checked' : '' }} onchange="this.form.submit()">
                                <div class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition-colors duration-300
                                            {{ $c->payment_status === 'paid' ? 'bg-green-500' : '' }}">
                                </div>
                                <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-0.5 -top-0.5 transition-transform duration-300
                                            {{ $c->payment_status === 'paid' ? 'translate-x-6' : '' }}">
                                </div>
                            </div>
                        </label>
                    </form>
                    @endif
                @else
                    <span class="text-gray-500">Belum menjadi customer</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
