<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Middleware admin cũ: chỉ cho tài khoản có role admin đi tiếp.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if(auth()->user()->role != 'admin'){
        abort(403);
    }
    return $next($request);
}
}
