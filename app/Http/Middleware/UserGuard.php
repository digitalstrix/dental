<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('user_token')&&session('user_type')=='user'){
            return $next($request);
        }else{
            return redirect(route('user_login_page'))->with('error', 'Session is Expired');
        }
        
    }
}