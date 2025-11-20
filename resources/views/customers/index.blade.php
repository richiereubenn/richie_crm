@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Projects</h2>
    @if(auth()->user()->role === 'Sales')
        <a href="{{ route('projects.create') }}" class="btn-primary">Add Project</a>
    @endif
</div>

<div class="bg-white shadow rounded">
    <table class="min-w-full">
        <thead>
            <tr class="border-b">
                <th>#</th>
                <th>Lead</th>
                <th>Product</th>
                <th>Status</th>
                <th>Approval Note</th>
                <th>Actions</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $p)
            <tr class="border-b">
                <td>{{ $p->id }}</td>
                <td>{{ $p->lead->name }}</td>
                <td>{{ $p->product->name }}</td>
                <td>
                    <span class="{{ $p->status === 'approved' ? 'bg-green-100 text-green-800' : ($p->status==='rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} px-2 py-1 rounded text-xs font-semibold">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td>{{ $p->approval_note ?? '-' }}</td>
                <td class="flex gap-2">
                    @if(auth()->user()->role === 'Sales' && $p->status==='pending')
                        <form action="{{ route('projects.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete project?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    @elseif(auth()->user()->role === 'Manager' && $p->status==='pending')
                        <button class="text-green-600 hover:text-green-800" onclick="openModal('approvalModal', {{ $p->id }}, 'approve')">Approve</button>
                        <button class="text-red-600 hover:text-red-800" onclick="openModal('rejectionModal', {{ $p->id }}, 'reject')">Reject</button>
                    @else
                        <span>—</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('projects.show', $p->id) }}" class="btn-secondary">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Approval Modal -->
<x-confirmation-modal id="approvalModal" title="Approve Project" button-text="Approve Project" button-color="green"
    label="Approval Note" placeholder="Enter approval note..." />

<!-- Rejection Modal -->
<x-confirmation-modal id="rejectionModal" title="Reject Project" button-text="Reject Project" button-color="red"
    label="Rejection Reason" placeholder="Enter rejection reason..." />

@push('scripts')
<script>
function openModal(modalId, projectId, action) {
    const form = document.getElementById(`${modalId}Form`);
    form.action = `/projects/${projectId}/${action}`;
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden'); // show modal
}
</script>
@endpush

@endsection
