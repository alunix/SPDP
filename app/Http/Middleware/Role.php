<?php
namespace SPDP\Http\Middleware;
use SPDP\User;

use Illuminate\Http\Response;
use Closure;
use Illuminate\Support\Facades\Auth;
class Role

 {
//   public function handle($request, Closure $next, User $types)
//   {
//     // Return Not Authorized error, if user has not logged in
//     if (!$request->user) {
//       SPDP::abort(401);
//     }

//     $types = explode(',', $types);
//     foreach ($types as $type) {
//       // if user has given role, continue processing the request

//       if ($request->user->hasRole($type)) {
//         return $next($request);
//       }
//     }
//     // user didn't have any of required roles, return Forbidden error
//     SPDP::abort(403);
//   }  
// }

public function handle($request, Closure $next, $types) 
{
    // if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
    //     return redirect('login');

    $user = \SPDP\User::find( \Auth::user()->id);
    

    $roles = explode(',', $roles);

    foreach ($roles as $role) {
      // if user has given role, continue processing the request
      if ($user->hasRole($role)) {
        return $next($request);
      }
    }
    // user didn't have any of required types, return Forbidden error
    SPDP::abort(403);


    

 

}

 }