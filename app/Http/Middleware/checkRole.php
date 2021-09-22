<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkRole
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
        $user = DB::table('users')->where('username', '=', session()->get('user'))
                ->get()->first();
        if ($user == null || $user->role != 1) {
                return redirect('/');
        }
        return $next($request);
    }
}
