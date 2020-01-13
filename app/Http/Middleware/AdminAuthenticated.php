<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminAuthenticated
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
     //   dd(Auth::user()->role->name);
        if(Auth::user()->role->name =='Customer'){
            return redirect('/home')->with('fail','You are not allowed to access.');
        }
        return $next($request);
    }
}
