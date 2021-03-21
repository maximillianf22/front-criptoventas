<?php

namespace App\Http\Middleware;

use Closure;

use Session, Redirect;

class AuthUserMiddleware
{
    public function handle($request, Closure $next)
    {
      if (Session::has('active_user')) {
        return $next($request);
      }else{
          session(['url.intended'=>$request->url()]);
        return Redirect::route('login');
      }
    }
}
