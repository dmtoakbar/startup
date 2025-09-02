<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Session;
use Illuminate\Support\Facades\Auth;

class EnsureAdminLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  

        if(Auth::check() && $request->session()->has('logged-password-input')) {
            return $next($request);
        } else {
          return redirect()->route('admin-login')->with('failed', 'Please login to proceed further...!');
        }
        
    }
}
