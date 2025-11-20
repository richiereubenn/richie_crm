@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold">Leads</h2>
  @if(auth()->user()->role === 'Sales')
    <a href="{{ route('leads.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add Lead</a>
  @endif
</div>

<div class="bg-white shadow rounded">
  <table class="min-w-full">
    <thead>
      <tr class="border-b">
        <th class="p-3 text-left">#</th>
        <th class="p-3 text-left">Name</th>
        <th class="p-3 text-left">Email</th>
        <th class="p-3 text-left">Phone</th>
        <th class="p-3 text-left">Address</th>
        <th class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($leads as $lead)
      <tr class="border-b">
        <td class="p-3">{{ $lead->id }}</td>
        <td class="p-3">{{ $lead->name }}</td>
        <td class="p-3">{{ $lead->email }}</td>
        <td class="p-3">{{ $lead->phone }}</td>
        <td class="p-3">{{ $lead->address }}</td>
        <td class="p-3 flex gap-2 justify-center">
          @if(auth()->user()->role === 'Sales' && $lead->user_id === auth()->id() || auth()->user()->role !== 'Sales')
            <a href="{{ route(name: 'leads.edit', parameters: $lead) }}" class="text-blue-600">Edit</a>
            <form action="{{ route(name: 'leads.destroy', parameters: $lead) }}" method="POST" onsubmit="return confirm('Delete lead?')">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600">Delete</button>
            </form>
          @else
            <span class="text-gray-400">—</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
