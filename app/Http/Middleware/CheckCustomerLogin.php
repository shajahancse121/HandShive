<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckCustomerLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = 'customer')
    {
        if (!Auth::guard($guard)->check()) {

            return redirect()->route('home');
        }
        return $next($request);
    }
}
