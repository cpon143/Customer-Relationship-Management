
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
        <h1 class="text-3xl font-semibold text-gray-700">Leads</h1>
        <div>
        <a href="{{ route('leads.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Add New Lead
        </a>
        <a href="{{ route('leads.upload') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2">
            Upload Leads
        </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <form method="GET" action="{{ route('leads') }}" class="mb-4 flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <!-- Search Bar -->
        <input 
            type="text" 
            name="search"
            placeholder="Search by name, number, or occupation..." 
            class="border border-gray-300 p-2 rounded-lg w-full lg:w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ request('search') }}"
        />

        <!-- Filters -->
        <div class="flex flex-col lg:flex-row mt-4 lg:mt-0 space-y-2 lg:space-y-0 lg:space-x-4">
            <div class="relative">
                <select name="occupation" class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Occupations</option>
                    <option value="student" {{ request('occupation') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="professional" {{ request('occupation') == 'professional' ? 'selected' : '' }}>Professional</option>
                    <option value="entrepreneur" {{ request('occupation') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                </select>
            </div>
            <div class="relative">
                <select name="status" class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Statuses</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Converted</option>
                    <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Filter</button>
        </div>
    </form>

    <!-- Leads Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Date</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Name</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Number</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Occupation</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Status</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $lead->created_at->format('d-M-Y') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $lead->name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $lead->phone }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $lead->occupation }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-{{ $lead->status_color }}-900 leading-tight">
                            <span class="absolute inset-0 {{ $lead->status_background_color }} opacity-50 rounded-full"></span>
                            <span class="relative">{{ ucfirst($lead->status) }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('leads.show', $lead) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View</a>
                        <a href="{{ route('leads.edit', $lead) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 ml-2">Edit</a>
                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <p class="text-sm text-gray-600">Showing {{ $leads->firstItem() }} to {{ $leads->lastItem() }} of {{ $leads->total() }} entries</p>
        <div class="inline-flex">
            {{ $leads->links() }}
        </div>
    </div>
</div>
@endsection