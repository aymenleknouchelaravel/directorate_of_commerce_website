<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StartPoint
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
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin/home');
            } elseif (auth()->user()->role == 'user') {
                return redirect('/user/home');
            } elseif (auth()->user()->role == 'worker') {
                return redirect('/worker/home');
            }
        }

        return $next($request);
    }
}