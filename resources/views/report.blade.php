@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Advisor Reports</h1>
        <div>
        <a href="{{ route('report.export.csv') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Export To CSV
        </a>
        <a href="{{ route('report.export.pdf') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2">
            Export To PDF
        </a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="mb-4 flex justify-between items-center">
        <!-- Date Filter -->
        <input 
            type="date" 
            class="border border-gray-300 p-2 rounded-lg w-1/4 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <!-- Advisor Filter Dropdown -->
        <select class="border border-gray-300 p-2 rounded-lg w-1/4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Advisors</option>
            @foreach($advisors as $advisor)
                <option value="{{ $advisor->id }}">{{ $advisor->name }}</option>
            @endforeach
        </select>

        <!-- Performance Filter Dropdown -->
        <select class="border border-gray-300 p-2 rounded-lg w-1/4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="leads">Total Leads</option>
            <option value="conversions">Conversions</option>
            <option value="revenue">Revenue Generated</option>
        </select>
    </div>

    <!-- Advisor Report Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Advisor Name</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Total Leads</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Conversions</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Revenue Generated</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Date Joined</th>
                    <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $report->advisor_name }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $report->total_leads }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $report->conversions }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">${{ number_format($report->revenue_generated, 2) }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $report->date_joined }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <p class="text-sm text-gray-600">Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} entries</p>
        {{ $reports->links() }}
    </div>
</div>
@endsection
