<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
               // Check if the authenticated user is an admin
               if (Auth::check() && Auth::user()->is_admin) {
                return $next($request);
            }
    
            // Redirect to home if not an admin
            return redirect('/')->with('error', 'You do not have admin access');
    }
}
