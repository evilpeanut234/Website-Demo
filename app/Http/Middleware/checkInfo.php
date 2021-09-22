<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkInfo
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
        if($user->name == null || $user->address == null || $user->phone == null){
            $msg = "Vui lòng cập nhật đầy đủ thông tin để tiếp";
            return redirect("profile/$user->username")->with('jsAlert', $msg);
        }
        return $next($request);
    }
}
