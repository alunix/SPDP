<?php

namespace SPDP\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class pjkMiddleware
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
        if ($request->user() && $request->user()->type != 'pjk' )
                { 
                return new Response(view('unauthorized')->with('role', 'Pusat Jaminan Kualiti' ));
                }
        return $next($request);
    }
}
