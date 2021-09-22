<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('Users.Login');
    }
    public function loginValid(Request $res)
    {
        $data = $res->input();
        $user = DB::table('users')
            ->where('username', '=', $data['username'])
            ->orWhere('email', '=', $data['username'])
            ->get()->first();
        if ($user !== null) {
            if (password_verify($data['pwd'], $user->password)) {
                if($user->email_verified_at!='0000-00-00 00:00:00'){
                    session()->put('user', $user->username);
                    session()->put('role', $user->role);
                    return redirect('/');
                }
                else{
                    return view('layouts.active');
                }
            } else {
                $msg = "Mật khẩu đăng nhập không chính xác";
            }
        } else {
            $msg = "Tài khoản không tồn tại";
        }
        return redirect('login')->with('status',"$msg");

    }
}
