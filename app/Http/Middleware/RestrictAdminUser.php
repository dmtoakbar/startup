<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Admindetail;
use App\Models\User;

class RestrictAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check_restrict = Admindetail::firstWhere('email', Auth::user()->email);
        if($check_restrict->user_status != "Restricted") {

            return $next($request);

        } else {

            $id = Auth::user()->id;
            $email = Auth::user()->email;
            Auth::logout();
            User::where('id', $id)->update(['remember_token' => null]);
            Admindetail::where('email', $email)->update(['last_log_out_time' => date("Y-m-d H:i:s")]);
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Auth::logoutOtherDevices($request->session()->get('logged-password-input'));
            $request->session()->forget('logged-password-input');

            $request->session()->flash('route-to-ridirect', 'admin-login');
            $request->session()->flash('key', 'failed');
            $request->session()->flash('message', 'You are restricted to work and login, Please wait for approval...!');
            return redirect()->route('clear-all-cache');
            exit();
        }
        
    }
}
