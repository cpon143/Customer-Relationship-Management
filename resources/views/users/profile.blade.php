@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">User Profile</h1>
    </div>

    <!-- Profile Update Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h3 class="text-lg font-semibold mb-4">Update Profile</h3>
        <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Profile Picture</label>
                <input type="file" name="profile_picture" class="border border-gray-300 p-2 rounded-lg w-full">
                @if($userDetail && $userDetail->profile_picture)
                    <img src="{{ asset('storage/' . $userDetail->profile_picture) }}" alt="Profile Picture" class="mt-2 w-20 h-20 rounded-full">
                @endif
            </div>

            <!-- Contact Number -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Contact Number</label>
                <input type="text" name="contact_number" value="{{ $userDetail->contact_number ?? '' }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" value="{{ $userDetail->email ?? '' }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Date of Birth</label>
                <input type="date" name="dob" value="{{ $userDetail->dob ?? '' }}" class="border border-gray-300 p-2 rounded-lg w-full">
            </div>

            <!-- Save Changes Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
