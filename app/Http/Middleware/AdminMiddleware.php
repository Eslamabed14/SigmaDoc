<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->userType == 1) {
                return $next($request);
            } elseif (Auth::user()->userType == 2 && Auth::user()->status == 'accepted') {
                return redirect(route('doc.serv'));
            } else {
                return redirect(route('home'));
            }
        } else {
            return redirect(route('login'));
        }
    }
}
