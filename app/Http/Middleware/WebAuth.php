<?php

namespace App\Http\Middleware;

use Closure;
use App\Auth;

class WebAuth
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
        if(!Auth::check())
        {
            
            return redirect()->action('AdminController@login_form')->with('failure','You must login to view this page');
        }
        elseif(Auth::banned())
        {
            return redirect()->action('AdminController@banned_form')->with('failure','You have been banned from admin panel');
        }
        return $next($request);
    }
}
