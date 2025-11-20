@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-600 text-black rounded hover:bg-gray-700">
            Back
        </a>
        <h2 class="text-2xl font-semibold">Project Detail</h2>
    </div>


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

        <div class="mt-4">
            <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
        </div>
    </div>
@endsection