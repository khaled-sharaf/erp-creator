<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @apiParam  \Illuminate\Http\Request  $request
     * @apiParam  \Closure  $next
     * @apiSuccess mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale($request->header('locale'));
        return $next($request);
    }
}
