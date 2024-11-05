@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-green-100 shadow-md rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-red-500 mb-4">Access Denied</h1>
            
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <p class="text-gray-700 mb-4">You do not have permission to access this page.</p>
            <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-800 font-semibold">Go to Dashboard</a>
        </div>
    </div>
@endsection
