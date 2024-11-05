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
        <h1 class="text-3xl font-semibold text-gray-700">Admin Dashboard</h1>
        <div>
            <a href="{{ route('advisors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Add New Advisor
            </a>
            <a href="{{ route('admins.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2">
                Add New Admin
            </a>
        </div>
    </div>

    <!-- Admin Management -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h3 class="text-lg font-semibold mb-4">Admin Management</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Name</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Email</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Password</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Role</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->email }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <span id="password-text-{{ $admin->id }}" class="hidden">{{ $admin->password }}</span>
                                    <button id="toggle-password-{{ $admin->id }}" class="ml-2 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c1.25 2.15 3.66 6 9 6s7.75-3.85 9-6-3.66-6-9-6-7.75 3.85-9 6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 00-6 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->role }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route('admins.edit', $admin->id) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Edit
                                </a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <p class="text-sm text-gray-600">Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} entries</p>
        <div class="inline-flex">
            {{ $admins->links() }}
        </div>
    </div>

    <!-- Advisor Management -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h3 class="text-lg font-semibold mb-4">Advisor Management</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Name</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Email</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Password</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Role</th>
                        <th class="px-5 py-3 bg-gray-50 text-gray-800 text-left text-sm uppercase font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advisors as $advisor)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $advisor->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $advisor->email }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <span id="password-text-{{ $advisor->id }}" class="hidden">{{ $advisor->password }}</span>
                                    <button id="toggle-password-{{ $advisor->id }}" class="ml-2 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c1.25 2.15 3.66 6 9 6s7.75-3.85 9-6-3.66-6-9-6-7.75 3.85-9 6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 00-6 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $advisor->role }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ route('advisors.edit', $advisor->id) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Edit
                                </a>
                                <form action="{{ route('advisors.destroy', $advisor->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <p class="text-sm text-gray-600">Showing {{ $advisors->firstItem() }} to {{ $advisors->lastItem() }} of {{ $advisors->total() }} entries</p>
        <div class="inline-flex">
            {{ $advisors->links() }}
        </div>
    </div>

</div>

<script>
    // Loop through each admin row to set up event listeners
    @foreach($admins as $admin)
        document.getElementById('toggle-password-{{ $admin->id }}').addEventListener('click', function() {
            const passwordText = document.getElementById('password-text-{{ $admin->id }}');
            passwordText.classList.toggle('hidden');
            
            // Change the icon based on visibility
            if (passwordText.classList.contains('hidden')) {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 00-6 0" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c1.25 2.15 3.66 6 9 6s7.75-3.85 9-6-3.66-6-9-6-7.75 3.85-9 6z" />
                </svg>`;
            } else {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a3 3 0 006 0M3 12c1.25-2.15 3.66-6 9-6s7.75 3.85 9 6-3.66 6-9 6-7.75-3.85-9-6z" />
                </svg>`;
            }
        });
    @endforeach

    // Loop through each advisor row to set up event listeners
    @foreach($advisors as $advisor)
        document.getElementById('toggle-password-{{ $advisor->id }}').addEventListener('click', function() {
            const passwordText = document.getElementById('password-text-{{ $advisor->id }}');
            passwordText.classList.toggle('hidden');
            
            // Change the icon based on visibility
            if (passwordText.classList.contains('hidden')) {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 00-6 0" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12c1.25 2.15 3.66 6 9 6s7.75-3.85 9-6-3.66-6-9-6-7.75 3.85-9 6z" />
                </svg>`;
            } else {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a3 3 0 006 0M3 12c1.25-2.15 3.66-6 9-6s7.75 3.85 9 6-3.66 6-9 6-7.75-3.85-9-6z" />
                </svg>`;
            }
        });
    @endforeach
</script>

@endsection
