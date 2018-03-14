<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\User;

class DecentralizeUsers
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
        $current_user = (new User())->find(Auth::user()->id);

        if ($current_user->can(Route::currentRouteName())) {
            return $next($request);
        }
        return abort(403, "Permission's denied!");
    }
}
