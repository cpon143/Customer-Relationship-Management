<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Admin::query();

        $admins = $query->paginate(10);
        $advisors = Advisor::paginate(10);

        return view('admins', compact('admins', 'advisors'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admins,email',
            'password' => 'required|string|max:50', // Password will be hashed
            'role' => 'required|string|max:50',
        ]);

        // Hash the password before saving
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->input('password')); // Hash the password

        Admin::create($requestData); // Create the admin with hashed password

        return redirect()->route('admins')->with('success', 'Admin created successfully.');
    }

    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|max:50', // Make password nullable for updates
            'role' => 'required|string|max:50',
        ]);

        // Prepare data for update
        $requestData = $request->all();

        // Hash the password if it's provided
        if ($request->filled('password')) {
            $requestData['password'] = Hash::make($request->input('password')); // Hash the new password
        } else {
            // If no password is provided, retain the current password
            unset($requestData['password']);
        }

        $admin->update($requestData); // Update the admin with the new data

        return redirect()->route('admins')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admins')->with('success', 'Admin deleted successfully.');
    }
}
