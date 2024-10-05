<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2') {
                // Admin (1) and Agent (2) are allowed to proceed
                return $next($request);
            } else {
                return redirect('/home')->with('status', 'Access Denied! You do not have admin or agent privileges.');
            }
        } else {
            return redirect('/home')->with('status', 'Please login first.');
        }
    }
}
