<?php

namespace SPDP\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
class fakultiMiddleware
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

        if ($request->user() && $request->user()->type != 'fakulti' )
                    { 
                    return new Response(view('unauthorized')->with('role', 'Pihak Fakulti' ));
                    }

        return $next($request);
    }
}
