<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guard)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->roles()->first()->slug == 'admin') {
                return redirect('dashboard');
            } else if (Auth::user()->roles()->first()->slug == 'customer' ) {
                return redirect('customer_dashboard');
            }
            else if (Auth::user()->roles()->first()->slug == 'employee' ) {
                return redirect('employ_dashboard');
            }
            else {
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
