@extends('layouts.app')

@section('content')
<div class="p-8">

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Calling Portal</h1>
        <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
            Retry All
        </button>
    </div>

    <!-- Check if advisor is logged in -->
    @if (Auth::check())
        <p>Logged in as: {{ Auth::user()->name }}</p>
    @else
        <p>Not logged in</p>
    @endif

    <!-- Search and Filters -->
    <div class="mb-4 flex justify-between items-center">
        <!-- Search Bar -->
        <input 
            type="text" 
            placeholder="Search by phone number..." 
            class="border border-gray-300 p-2 rounded-lg w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500"
        />

        <!-- Status Filter Dropdown -->
        <div class="relative">
            <select class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">All Statuses</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
        </div>
    </div>

    <!-- Call List Table -->
    
    <!-- <div class="p-8"> -->
    <div >
        <!-- <h1 class="text-3xl font-semibold text-gray-700">Calling Portal</h1> -->

        <!-- Call List Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-6">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Phone Number</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Date</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Amount</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Status</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allLeads as $lead)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $lead->phone }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $lead->created_at->format('d-M-Y') }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $lead->amount }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold text-{{ $lead->status_color }}-900 leading-tight">
                                <!-- <span class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span> -->
                                <span class="absolute inset-0 {{ $lead->status_background_color }} opacity-50 rounded-full"></span>
                                <span class="relative">{{ ucfirst($lead->status) }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('calling-portal.edit', $lead->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination (if necessary) -->
    <div class="flex justify-between mt-4">
        <p class="text-sm text-gray-600">Showing 1 to 10 of 50 entries</p>
        <div class="inline-flex">
            <button class="bg-gray-200 text-gray-700 px-3 py-2 rounded-l hover:bg-gray-300">Prev</button>
            <button class="bg-gray-200 text-gray-700 px-3 py-2 rounded-r hover:bg-gray-300">Next</button>
        </div>
    </div>
</div>
@endsection
