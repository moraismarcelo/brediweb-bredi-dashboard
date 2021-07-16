<?php

namespace Bredi\BrediDashboard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class RedirectDashboard
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Route::getCurrentRoute()->getName() == "bredidashboard::login" || Route::getCurrentRoute()->getName() == "login") {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('bredidashboard::dashboard');
            }   
        }
        
        return $next($request);
    }

}
