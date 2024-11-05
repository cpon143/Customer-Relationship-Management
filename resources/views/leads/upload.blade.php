
@extends('layouts.app')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-semibold text-gray-700">Upload Leads</h1>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
        <form method="POST" action="{{ route('leads.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Select Excel File</label>
                <input type="file" name="file" class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Upload</button>
        </form>
    </div>
</div>
@endsection