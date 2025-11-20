@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Customer List</h2>
    </div>

    <div class="bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Lead Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-center">Total Products</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $lead_id => $items)
                    @php $lead = $items->first()->project->lead; @endphp
                    <tr class="border-b">
                        <td class="p-3 text-left">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $lead->name }}</td>
                        <td class="p-3">{{ $lead->email }}</td>
                        <td class="p-3">{{ $lead->phone }}</td>
                        <td class="p-3 text-center">{{ $items->count() }} produk</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('customers.detail', $lead) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4">No approved projects yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection