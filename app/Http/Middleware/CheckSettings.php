<?php

namespace App\Http\Middleware;

use Closure;
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
        $env_path = base_path('.env');
        if (file_exists($env_path)) {
            try {
                if (! is_null((DB::connection()->getDatabaseName()))) {
                    if (Request::is('install')) {
                        return redirect('/');
                    }
                    return $next($request);
//                    $response = $next($request);
//                    return $response;
                } else {
                    return redirect('/install');
                }
            } catch (PDOException $e) {
                echo 'Error';
                exit();
            }
        } else {
            try {
                copy(base_path('.env.sample'), $env_path);

                return redirect('/');
            } catch (\Error $err) {
                exit('Please check FlyMyShop has write permissions!');
            }
        }
    }
}
