<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisor;
use Illuminate\Support\Facades\Hash;

class AdvisorController extends Controller
{
    public function index(Request $request)
    {
        $query = Advisor::query();

        $advisors = $query->paginate(10);

        return view('admins', compact('admins'));
    }

    public function create()
    {
        return view('advisors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:advisors,email',
            'password' => 'required|string|max:50',
            'role' => 'required|string|max:50',
        ]);

        // Hash the password before storing
        $advisorData = $request->all();
        $advisorData['password'] = Hash::make($request->input('password'));

        Advisor::create($advisorData);

        return redirect()->route('admins')->with('success', 'Advisor created successfully.');
    }

    public function edit(Advisor $advisor)
    {
        return view('advisors.edit', compact('advisor'));
    }

    public function update(Request $request, Advisor $advisor)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:advisors,email,' . $advisor->id,
            'password' => 'nullable|string|max:50', // Allow empty for password update
            'role' => 'required|string|max:50',
        ]);

        // Update the advisor's data
        $advisorData = $request->all();
        
        // Hash the password if it's provided
        if ($request->filled('password')) {
            $advisorData['password'] = Hash::make($request->input('password'));
        } else {
            unset($advisorData['password']); // Remove password if not provided
        }

        $advisor->update($advisorData);

        return redirect()->route('admins')->with('success', 'Advisor updated successfully.');
    }

    public function destroy(Advisor $advisor)
    {
        $advisor->delete();

        return redirect()->route('admins')->with('success', 'Advisor deleted successfully.');
    }
}
