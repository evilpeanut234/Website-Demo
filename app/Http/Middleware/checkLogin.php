<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkLogin
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
        $value = $request->session()->get('user','default');

        if($value!='default'){
            return $next($request);
        }else{
            return response()->view('layouts.error');
        }
    }
}
