@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Projects</h2>
        @if(auth()->user()->role === 'Sales')
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Project
            </a>
        @endif
    </div>

    <div class="bg-white shadow rounded">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Lead</th>
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Approval Note</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $p)
                    <tr class="border-b">
                        <td class="p-3">{{ $p->id }}</td>
                        <td class="p-3">{{ $p->lead->name }}</td>
                        <td class="p-3">{{ $p->product->name }}</td>
                        <td class="p-3">
                            <span
                                class="px-2 py-1 rounded text-xs font-semibold
                                                            {{ $p->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                                            {{ $p->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                                            {{ $p->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="p-3">{{ $p->approval_note ?? '-' }}</td>
                        <td class="p-3 flex gap-2 justify-center">
                            @if(auth()->user()->role === 'Sales')
                                @if($p->status === 'pending')
                                    <form action="{{ route('projects.destroy', $p) }}" method="POST"
                                        onsubmit="return confirm('Delete project?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            @elseif(auth()->user()->role === 'Manager')
                                @if($p->status === 'pending')
                                    <button data-twe-toggle="modal" data-twe-target="#approvalModal" data-twe-ripple-init
                                        data-twe-ripple-color="light" onclick="openModal('approvalModal', {{ $p->id }}, 'approve')"
                                        class="text-green-600 hover:text-green-800">
                                        Approve
                                    </button>
                                    <button data-twe-toggle="modal" data-twe-target="#rejectionModal" data-twe-ripple-init
                                        data-twe-ripple-color="light" onclick="openModal('rejectionModal', {{ $p->id }}, 'reject')"
                                        class="text-red-600 hover:text-red-800 ml-2">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-gray-500">—</span>
                                @endif
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-confirmation-modal id="approvalModal" title="Approve Project" button-text="Approve Project" button-color="green"
        label="Approval Note" placeholder="Enter approval note..." />

    <x-confirmation-modal id="rejectionModal" title="Reject Project" button-text="Reject Project" button-color="red"
        label="Rejection Reason" placeholder="Enter rejection reason..." />

    @push('scripts')
        <script>
            function openModal(modalId, projectId, action) {
                const form = document.getElementById(`${modalId}Form`);
                form.action = `/projects/${projectId}/${action}`;
            }
        </script>
    @endpush
@endsection