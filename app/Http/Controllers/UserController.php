<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;     // Add this line
use App\Models\Advisor;   // Add this line


class UserController extends Controller
{
    

    public function profile()
    {
        $user_id = session('user_id');
        $user_type = session('user_type');

        $userDetail = UserDetail::where('user_id', $user_id)->where('user_type', $user_type)->first();

        return view('users.profile', compact('userDetail'));
    }

    

    public function updateProfile(Request $request)
    {
        $user_id = session('user_id');      // Admin or Advisor ID
        $user_type = session('user_type');  // 'admin' or 'advisor'


        //without fetching name form admin and advisor table
        // $request->validate([
        //     'name' => 'required|string|max:100',
        //     'contact_number' => 'required|string|max:20',
        //     'dob' => 'nullable|date',
        //     'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        // ]);

        
        //  // Update or create user details in the user_details table
        // $userDetail = UserDetail::updateOrCreate(
        //     ['user_id' => $user_id, 'user_type' => $user_type],
        //     $request->only('name', 'contact_number', 'dob')
        // );


        //fetching name from admin and advisor table
        $request->validate([
            'name' => 'required|string|max:100',
            'contact_number' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update name in the respective table
        if ($user_type === 'admin') {
            Admin::where('id', $user_id)->update(['name' => $request->name]);
        } elseif ($user_type === 'advisor') {
            Advisor::where('id', $user_id)->update(['name' => $request->name]);
        }

        // Update or create user details in the user_details table
        $userDetail = UserDetail::updateOrCreate(
            ['user_id' => $user_id, 'user_type' => $user_type],
            $request->only('name', 'contact_number', 'dob')
        );

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Check and delete the previous profile picture if it exists
            if ($userDetail->profile_picture) {
                Storage::delete('public/' . $userDetail->profile_picture);
            }

            // Store the new profile picture
            $userDetail->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $userDetail->save();
        }

        

        return redirect()->route('user.showProfile')->with('success', 'Profile updated successfully.');
    }


    public function showProfile()
    {
        $user_id = session('user_id');
        $user_type = session('user_type');
        $userDetail = UserDetail::where('user_id', $user_id)->where('user_type', $user_type)->first();
        \Log::info('User Type:', ['type' => session('user_type')]);
        
        return view('users.profile-view', compact('userDetail'));
    }

    public function editProfile()
    {
        $user_id = session('user_id');
        $user_type = session('user_type');
        $userDetail = UserDetail::where('user_id', $user_id)->where('user_type', $user_type)->first();

        return view('users.profile-edit', compact('userDetail'));
    }
}