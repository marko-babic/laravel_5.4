<?php

namespace L2\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {

    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->isAdmin() ) {
            return $next($request);
        }

        return redirect()->route('home');
    }

}
