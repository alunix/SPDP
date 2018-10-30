<?php

namespace SPDP\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class senatMiddleware
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
        $response = $next($request);
        if ($request->user() && $request->user()->type != 'senat' )
                    { 
                    return new Response(view('unauthorized')->with('role', 'Urus Setia Senat' ));
                    }

        return $next($request);
    }
}
