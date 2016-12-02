<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isSuperAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin') {
        if (!Auth::guard($guard)->check()) {
            return redirect('/admin/member');
        }

        if ((Auth::guard($guard)->user()->role != 'superAdmin')) {
            return redirect('/admin/member');
        }
        return $next($request);
    }

}
