<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $domains = [
            'http://localhost:8080',
            'http://192.168.1.1:8080',
            'http://192.168.1.2:8080',
            'http://192.168.1.3:8080',
            'http://192.168.1.4:8080',
            'http://192.168.1.5:8080',
            'http://192.168.1.6:8080',
            'http://192.168.1.7:8080',
            'http://192.168.1.8:8080',
            'http://192.168.1.9:8080',
            'http://192.168.1.10:8080'
        ];

        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if(in_array($origin, $domains)) {
                header('Access-Control-Allow-Origin:' . $origin);
                header('Access-Control-Allow-Headers: X-Requested-With, Accept, Origin, Content-Type, Authorization');
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Allow-Methods: HEAD, POST, GET, DELETE, PUT, PATCH, OPTIONS');
                header('Access-Control-Max-Age: 86400');
            }
        }
        return $next($request);
    }
}
