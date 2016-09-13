<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Request;

class CheckSettings
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!is_null((DB::connection()->getDatabaseName()))) {
                if (Request::is('install')) {
                    return redirect('/');
                }
                return $next($request);
            } else {
                return redirect('/install');
            }

        } catch (PDOException $e) {
            echo('Error');
            exit();

        }
    }
}
