@extends('layouts.app')

@section('content')
    <div class="mb-6 items-center">
        <a href="{{ route('customers.index') }}"
            class="inline-flex items-center mb-2 text-gray-600 hover:text-gray-800 transition-all duration-150">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
        <h2 class="text-2xl font-semibold">Customer Detail</h2>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border mb-6">
        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Customer Information</h3>
        <div class="space-y-2">
            <p><strong>Name:</strong> {{ $lead->name }}</p>
            <p><strong>Email:</strong> {{ $lead->email }}</p>
            <p><strong>Phone:</strong> {{ $lead->phone }}</p>
            <p><strong>Address:</strong> {{ $lead->address }}</p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <h3 class="text-lg font-semibold p-4 border-b">Purchased Products</h3>
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Payment Date</th>
                    <th class="p-3 text-left">Expired</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    @php $cust = $project->customer; @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $project->product->name }}</td>

                        {{-- Status --}}
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ $cust && $cust->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $cust->payment_status ?? 'unpaid' }}
                            </span>
                        </td>

                        {{-- Payment Date --}}
                        <td class="p-3">{{ $cust->payment_date ? date('d M Y', strtotime($cust->payment_date)) : '-' }}</td>

                        {{-- Expired Date --}}
                        <td class="p-3">{{ $cust->expired_date ? date('d M Y', strtotime($cust->expired_date)) : '-' }}</td>

                        {{-- Action --}}
                        <td class="p-3 text-center">
                            @if(!$cust || $cust->payment_status !== 'paid')
                                <form method="POST" action="{{ route('customers.pay', $project->id) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-sm shadow-sm">
                                        Mark as Paid
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 font-semibold">Paid</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">No purchased products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
