<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'role' => 'required|in:admin,advisor',
    //     ]);

    //     // Check the user based on role
    //     $credentials = $request->only('email', 'password');
        
    //     if ($request->role === 'admin') {
    //         if (Auth::guard('admin')->attempt($credentials)) {
    //             \Log::info('Admin logged in');
    //             // Store admin user_id and user_type in session
    //             session(['user_id' => Auth::guard('admin')->id(), 'user_type' => 'admin']);
    //             return redirect()->route('admins')->with('success', 'Logged in as Admin');
    //         }
    //     } else {
    //         if (Auth::guard('advisor')->attempt($credentials)) {
    //             \Log::info('Advisor logged in');
    //             // Store advisor user_id and user_type in session
    //             session(['user_id' => Auth::guard('advisor')->id(), 'user_type' => 'advisor']);
    //             return redirect()->route('dashboard')->with('success', 'Logged in as Advisor');
    //         }
    //     }

    //     return back()->with('error', 'Invalid credentials');
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,advisor',
        ]);

        $credentials = $request->only('email', 'password');
        
        if ($request->role === 'admin' && Auth::guard('admin')->attempt($credentials)) {
            \Log::info('Admin logged in');
            session(['user_id' => Auth::guard('admin')->id(), 'user_type' => 'admin']);
            return redirect()->route('admins')->with('success', 'Logged in as Admin');
        } elseif ($request->role === 'advisor' && Auth::guard('advisor')->attempt($credentials)) {
            \Log::info('Advisor logged in');
            session(['user_id' => Auth::guard('advisor')->id(), 'user_type' => 'advisor']);
            return redirect()->route('dashboard')->with('success', 'Logged in as Advisor');
        }

        return back()->with('error', 'Invalid credentials');
    }

}
