<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;

class CheckSettings
{
    /**
     * Handle an incoming request.
     *
     * Check database is configured properly if not send to install
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

                    if (Auth::check()) {
                        $id = Auth::user()->id;
                        $currentuser = User::find($id);

                        if ($currentuser->status == '0') {
                            Auth::logout();
                            $request->session()->flash('alert-danger', 'Your account has been disabled!');
                            redirect('/');
                        }
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
