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
                    <th class="p-3 text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $p)
                    <tr class="border-b">
                        <td class="p-3">{{ $p->id }}</td>
                        <td class="p-3">{{ $p->lead->name }}</td>
                        <td class="p-3">{{ $p->product->name }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-semibold
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
                                    <button onclick="openModal('approve', {{ $p->id }})" class="text-green-600 hover:text-green-800">
                                        Approve
                                    </button>
                                    <button onclick="openModal('reject', {{ $p->id }})" class="text-red-600 hover:text-red-800 ml-2">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-gray-500">—</span>
                                @endif
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            <a href="{{ route('projects.detail', $p->id) }}"
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
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="approvalModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4"></h3>
                <form id="approvalForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2" id="modalLabel"></label>
                        <textarea name="approval_note" rows="4"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your note here..." required></textarea>
                    </div>
                    <div class="flex gap-3 justify-end">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md">
                            Cancel
                        </button>
                        <button type="submit" id="modalSubmitBtn" class="px-4 py-2 text-white rounded-md">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(action, projectId) {
            const modal = document.getElementById('approvalModal');
            const form = document.getElementById('approvalForm');
            const title = document.getElementById('modalTitle');
            const label = document.getElementById('modalLabel');
            const submitBtn = document.getElementById('modalSubmitBtn');

            if (action === 'approve') {
                form.action = `/projects/${projectId}/approve`;
                title.textContent = 'Approve Project';
                label.textContent = 'Approval Note:';
                submitBtn.textContent = 'Approve';
                submitBtn.className = 'px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md';
            } else {
                form.action = `/projects/${projectId}/reject`;
                title.textContent = 'Reject Project';
                label.textContent = 'Rejection Reason:';
                submitBtn.textContent = 'Reject';
                submitBtn.className = 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md';
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('approvalModal');
            const form = document.getElementById('approvalForm');
            modal.classList.add('hidden');
            form.reset();
        }

        document.getElementById('approvalModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection