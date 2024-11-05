@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen rounded-lg" style="background: linear-gradient(to bottom right, #d9f9d9, #a8e6cf);">
    <div class="mb-8 flex justify-between items-center">
        
        @if(Auth::guard('admin')->check() || Auth::guard('advisor')->check())
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xl text-green-900 border-2 border-green-700 bg-transparent hover:bg-green-700 hover:text-white hover:border-transparent transition duration-300 py- px-4 rounded-full">
                    Logout
                </button>


            </form>
        @else
            <a href="{{ route('login') }}" class="text-white hover:text-yellow-400">Login</a>
         @endif

        @if (Auth::check())
            <span class="text-xl text-green-900"> Hi, {{ Auth::user()->name }}! You’re logged in.</span>
        @else
            <span class="text-sm text-green-900"> (Not logged in)</span>
        @endif
    </div>

    

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-xl mb-6 max-w-3xl mx-auto">
        <div class="mb-6 text-center">
            <h3 class="text-3xl font-semibold text-green-700">Your Details</h3>
        </div>

        <!-- Profile Picture -->
        <div class="mb-8 text-center">
            @if($userDetail && $userDetail->profile_picture)
            <img src="{{ asset('storage/' . $userDetail->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full shadow-lg mx-auto border-4 border-green-400">
            @else
            <p class="text-green-400 italic">No profile picture available.</p>
            @endif
            <label class="block text-green-500 font-semibold text-lg mb-2">Profile Picture</label>
        </div>

        <!-- Name -->
        <div class="mb-6">
            <label class="block text-green-500 font-medium text-lg mb-1">Name</label>
            <p class="text-2xl font-medium text-green-800 bg-green-100 p-4 rounded-lg shadow-sm tracking-wide">{{ $userDetail->name ?? 'N/A' }}</p>
        </div>

        <!-- Contact Number -->
        <div class="mb-6">
            <label class="block text-green-500 font-medium text-lg mb-1">Contact Number</label>
            <p class="text-2xl font-medium text-green-900 bg-green-100 p-4 rounded-lg shadow-sm tracking-wide">{{ $userDetail->contact_number ?? 'N/A' }}</p>
        </div>

        <!-- Date of Birth -->
        <div class="mb-6">
            <label class="block text-green-500 font-medium text-lg mb-1">Date of Birth</label>
            <p class="text-2xl font-medium text-green-900 bg-green-100 p-4 rounded-lg shadow-sm tracking-wide">{{ $userDetail->dob ?? 'N/A' }}</p>
        </div>

        <!-- Update Profile Button -->
        <div class="text-center mt-10">
            <a href="{{ route('user.editProfile') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold px-6 py-3 rounded-full hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg">
                Update Profile
            </a>
        </div>
    </div>
</div>
@endsection
