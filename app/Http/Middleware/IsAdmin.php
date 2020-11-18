<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // if (auth()->check() && auth()->user()->rule == 1) {
        if (auth()->check() && auth()->user()->active == 1) {
            return $next($request);
        }
        auth()->logout();
        return response(['message' => 'Forbidden! You don\'t have permission to access this method.'], 403);
    }
}
