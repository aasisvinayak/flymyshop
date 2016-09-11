<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class CheckSettings
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (DB::connection()->getDatabaseName()) {
            if (Request::is('install')) {
                redirect('/');
            }

            return $next($request);
        } else {
            redirect('/');
        }
    }
}
