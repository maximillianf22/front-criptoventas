<?php

namespace App\Http\Middleware;

use Closure;

use Session, Redirect;

class GuestUserMiddleware
{
    public function handle($request, Closure $next)
    {
      if (Session::has('active_user')) {
        return Redirect::route('home');
      }else{
        return $next($request);
      }
    }
}
