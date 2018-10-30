<?php

namespace SPDP\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class jppaMiddleware
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
        if ($request->user() && $request->user()->type != 'jppa' )
                    { 
                    return new Response(view('unauthorized')->with('role', ' Jawatankuasa Perancangan dan Perkembangan Akademik
                    (JPPA) ' ));
                    }
        return $next($request);
    }
}
