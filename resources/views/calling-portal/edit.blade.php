@extends('layouts.app')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-semibold mb-4">Edit Lead</h1>

    <form action="{{ route('calling-portal.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="border border-gray-300 p-2 rounded-lg w-full">
                <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="completed" {{ $lead->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="pending" {{ $lead->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ $lead->status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="number" name="phone" value="{{ $lead->phone }}" class="border border-gray-300 p-2 rounded-lg w-full" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Amount</label>
            <input type="number" name="amount" value="{{ $lead->amount }}" class="border border-gray-300 p-2 rounded-lg w-full" />
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" value="{{ $lead->date }}" class="border border-gray-300 p-2 rounded-lg w-full" />
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Update Lead
        </button>
    </form>
</div>
@endsection
