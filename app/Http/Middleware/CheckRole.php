<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Chặn người chưa đăng nhập hoặc người không có đúng vai trò route yêu cầu.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // chưa login
        if(!auth()->check()){
            return redirect('/login');
        }
        // check không đúng admin
        if(auth()->user()->role !== $role){
            abort(403);
        }
        return $next($request);
    }
}
