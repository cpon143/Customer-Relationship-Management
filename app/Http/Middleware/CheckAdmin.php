<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \Log::info('CheckAdmin middleware accessed.');

        if (!Auth::guard('admin')->check()) {
            \Log::warning('Admin not authenticated.');
            return redirect()->route('error')->with('error', 'You are not authorized to access this page.');
        }

        // if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
        //     \Log::info('Admin authenticated, proceeding.');
        //     return $next($request);
        // }

        \Log::info('Admin authenticated, proceeding.');
        return $next($request);
    }

}
