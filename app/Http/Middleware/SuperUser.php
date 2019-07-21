<?php

namespace App\Http\Middleware;

use Closure;


class SuperUser
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
        if(!$request->user()->is_superuser()) {
            return abort(404);
            //echo $request->user()->is_superuser();
        }
        return $next($request);
    }
}
