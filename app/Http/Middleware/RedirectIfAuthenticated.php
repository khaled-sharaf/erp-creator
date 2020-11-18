<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @apiParam  \Illuminate\Http\Request  $request
     * @apiParam  \Closure  $next
     * @apiParam  string|null  $guard
     * @apiSuccess mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(env('CP_PREFIX') . '/dashboard');
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
