@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Edit Admin</h2>
    <form method="POST" action="{{ route('admins.update', $admin->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="{{ $admin->name }}" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $admin->email }}" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" value="{{ $admin->password }}" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Role</label>
            <input type="text" name="role" value="{{ $admin->role }}" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Save Changes
        </button>
    </form>
</div>
@endsection
