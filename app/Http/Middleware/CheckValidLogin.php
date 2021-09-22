<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckValidLogin
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
        $id = $request->route('username');
        if(session()->get('user')!=$id){
            return redirect('/');
        }
        return $next($request);
    }
}
