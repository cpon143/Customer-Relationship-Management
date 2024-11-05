
@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Edit Lead</h1>
    </div>

    <!-- Lead Form -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
        <form method="POST" action="{{ route('leads.update', $lead->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" value="{{ $lead->name }}" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Number</label>
                <input type="text" name="phone" value="{{ $lead->phone }}" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">E-mail</label>
                <input type="email" name="email" value="{{ $lead->email }}" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Occupation</label>
                <input type="text" name="occupation" value="{{ $lead->occupation }}" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="completed" {{ $lead->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
                    <option value="pending" {{ $lead->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ $lead->status == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection