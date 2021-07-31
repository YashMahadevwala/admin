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
        if(!session() -> has('fullname') && ($request->path() != 'admin/login')){
            return redirect()->route('admin.login');
        }
        if(session() -> has('fullname') && ($request->path() == 'admin/login' || $request->path() == 'admin/registration')){
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
