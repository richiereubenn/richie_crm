@extends('layouts.app')

@section('content')
<a href="{{ route('customers.index') }}" class="mb-4 inline-block text-gray-600">← Back</a>
<h2 class="text-2xl font-semibold mb-4">Lead Detail</h2>

<div class="bg-white p-4 rounded shadow mb-6">
    <h3 class="text-lg font-semibold mb-2">Lead Information</h3>
    <p><strong>Name:</strong> {{ $lead->name }}</p>
    <p><strong>Email:</strong> {{ $lead->email }}</p>
    <p><strong>Phone:</strong> {{ $lead->phone }}</p>
    <p><strong>Address:</strong> {{ $lead->address }}</p>
</div>

<h3 class="text-lg font-semibold mb-2">Purchased Products</h3>

<table class="min-w-full bg-white shadow rounded">
    <thead>
        <tr>
            <th class="p-3 text-left">Product</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Payment Date</th>
            <th class="p-3 text-left">Expired</th>
            <th class="p-3 text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
            @php $cust = $project->customer; @endphp
            <tr>
                <td class="p-3">{{ $project->product->name }}</td>
                <td class="p-3">{{ $cust->payment_status ?? 'unpaid' }}</td>
                <td class="p-3">{{ $cust->payment_date ?? '-' }}</td>
                <td class="p-3">{{ $cust->expired_date ?? '-' }}</td>
                <td class="p-3 text-center">
                    @if(!$cust || $cust->payment_status !== 'paid')
                        <form method="POST" action="{{ route('customers.pay', $project->id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-green-600 text-white rounded">
                                Mark as Paid
                            </button>
                        </form>
                    @else
                        <span class="text-green-600">Paid</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection