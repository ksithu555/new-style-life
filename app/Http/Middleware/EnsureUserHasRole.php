<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        print_r($role);
        if (! $request->user()->hasRole($role)) {
            abort(401, 'This action is unauthorized.');
        }

        return $next($request);
    }

}