<?php

namespace App\Http\Middleware;

use App\Http\Models\UserType;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckUserType
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
        if (! Auth::check()) {
            return redirect('/login');
        } elseif (Auth::check()) {
            $id = Auth::user()->id;
            $type = UserType::getType($id);

            if (count($type) > 0) {
                $isAdmin = $type[0]->type == 'admin' ? true : false;
            } else {
                $isAdmin = false;
            }

            if ($isAdmin == false) {
                Session::flash('alert-danger', 'You are not admin!');

                return redirect('/');
            }
        }



        return $next($request);
        
    }
}
