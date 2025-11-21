@extends('layouts.app')

@section('content')
    <div class="mb-6 items-center">
        <a href="{{ route('projects.index') }}"
            class="inline-flex items-center mb-2 text-gray-600 hover:text-gray-800 transition-all duration-150">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
        <h2 class="text-2xl font-semibold">Project Detail</h2>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md border">
            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Lead Information</h3>
            <div class="space-y-2">
                <p><strong>Name:</strong> {{ $project->lead->name }}</p>
                <p><strong>Email:</strong> {{ $project->lead->email ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $project->lead->phone ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border">
            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Product Information</h3>
            <div class="space-y-2">
                <p><strong>Name:</strong> {{ $project->product->name }}</p>
                <p><strong>Description:</strong> {{ $project->product->description }}</p>
                <p><strong>Price:</strong> Rp{{ number_format($project->product->price) }}</p>
                <p><strong>Subscription Period:</strong> {{ $project->product->subscription_period }} days</p>
            </div>
        </div>
    </div>
@endsection