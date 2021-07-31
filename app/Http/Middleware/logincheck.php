<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class logincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session() -> has('fullname') && ($request->path() != 'login')){
            return redirect('login');
        }
        if(session() -> has('fullname') && ($request->path() == 'login' || $request->path() == 'registration')){
            return redirect('dashboard');
        }
        return $next($request);
    }
}
