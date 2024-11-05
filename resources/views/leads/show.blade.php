
@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Lead Details</h1>
    </div>

    <!-- Lead Details -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <p class="border border-gray-300 p-2 rounded-lg w-full">{{ $lead->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Number</label>
            <p class="border border-gray-300 p-2 rounded-lg w-full">{{ $lead->phone }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Occupation</label>
            <p class="border border-gray-300 p-2 rounded-lg w-full">{{ $lead->occupation }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <p class="border border-gray-300 p-2 rounded-lg w-full">{{ ucfirst($lead->status) }}</p>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('leads') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Back</a>
        </div>
    </div>
</div>
@endsection