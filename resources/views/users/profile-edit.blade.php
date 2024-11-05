@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen rounded-lg" style="background: linear-gradient(to bottom right, #d9f9d9, #a8e6cf);">
    <!-- Header Section -->
    <!-- <div class="mb-8 text-center">
        <h1 class="text-5xl font-extrabold text-transparent tracking-wide bg-clip-text bg-gradient-to-r from-green-600 to-green-500">
            Update Profile
        </h1>
    </div> -->

    <div class="mb-8 flex justify-between items-center">
    @if(Auth::guard('admin')->check() || Auth::guard('advisor')->check())
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xl text-green-900 border-2 border-green-700 bg-transparent hover:bg-green-700 hover:text-white hover:border-transparent transition duration-300 py-1 px-4 rounded-full">
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

    <!-- Profile Update Form -->
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-3xl mx-auto">
        <h3 class="text-3xl font-semibold text-green-700 text-center mb-6">Update Your Details</h3>

        <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture -->
             <!-- //old -->
            <div class="mb-8 text-center">
                <input type="file" name="profile_picture" class="border border-green-300 p-2 rounded-lg w-full mb-4">
                @if($userDetail && $userDetail->profile_picture)
                <img src="{{ asset('storage/' . $userDetail->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full shadow-lg mx-auto border-4 border-green-400">
                @endif
                <label class="block text-green-500 font-semibold text-lg mb-2">Profile Picture</label>
            </div>

            <!-- new proper not working -->
            <!-- <div class="mb-8 text-center relative group">
                @if($userDetail && $userDetail->profile_picture)
                    <img src="{{ asset('storage/' . $userDetail->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 rounded-full shadow-lg mx-auto border-4 border-green-400">
                    <label class="block text-green-500 font-semibold text-lg mb-2">Profile Picture</label>
                    
                    
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <input type="file" name="profile_picture" class="border border-green-300 p-2 rounded-lg w-full mb-4 absolute inset-0 opacity-0 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                @endif
            </div> -->



            <!-- Name -->
            <div class="mb-6">
                <label class="block text-green-500 font-medium text-lg mb-1">Name</label>
                <input type="text" name="name" value="{{ $userDetail->name ?? '' }}" class="text-2xl text-green-900 bg-green-100 p-4 rounded-lg shadow-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Contact Number -->
            <div class="mb-6">
                <label class="block text-green-500 font-medium text-lg mb-1">Contact Number</label>
                <input type="text" name="contact_number" value="{{ $userDetail->contact_number ?? '' }}" class="text-2xl text-green-900 bg-green-100 p-4 rounded-lg shadow-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Date of Birth -->
            <div class="mb-6">
                <label class="block text-green-500 font-medium text-lg mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ $userDetail->dob ?? '' }}" class="text-2xl text-green-900 bg-green-100 p-4 rounded-lg shadow-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Save Changes Button -->
            <div class="text-center mt-10">
                <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold px-6 py-3 rounded-full hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
