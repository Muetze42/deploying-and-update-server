<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request                                                         $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $file = dirname(base_path()) . '/ips';

        if (file_exists($file)) {
            $ips = array_filter(explode("\n", file_get_contents($file)));

            if (!in_array($request->ip(), $ips)) {
                abort(401);
            }
        }

        return $next($request);
    }
}
