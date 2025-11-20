@extends('layouts.app')

@section('content')
    <a href="{{ route('customers.index') }}" class="mb-4 inline-block text-gray-600">← Back</a>

    <h2 class="text-2xl font-semibold">Project Detail</h2>


    <div class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <h3 class="font-semibold">Lead Information</h3>
            <p><strong>Name:</strong> {{ $project->lead->name }}</p>
            <p><strong>Email:</strong> {{ $project->lead->email ?? '-' }}</p>
            <p><strong>Phone:</strong> {{ $project->lead->phone ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold">Product Information</h3>
            <p><strong>Name:</strong> {{ $project->product->name }}</p>
            <p><strong>Description:</strong> {{ $project->product->description }}</p>
            <p><strong>Price:</strong> {{ number_format($project->product->price) }}</p>
            <p><strong>Subscription Period:</strong> {{ $project->product->subscription_period }} days</p>
        </div>
    </div>
@endsection