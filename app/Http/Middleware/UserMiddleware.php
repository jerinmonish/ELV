<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role != 'user')
        {
            return new Response(view('unauthorized')->with('role', 'User'));
        }
        return $next($request);
    }
}
