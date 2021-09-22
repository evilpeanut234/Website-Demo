<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ForgotController extends Controller
{
    public function forgot(Request $res)
    {
        $email = $res->cookie('email');
        return view('Users.Forgot');
    }

    public function forgotPassword(Request $request)
    {
        $rule = [
            'email' => 'required|email|min:6|max:32',
        ];
        $customMessage = [
            // Email
            'email.required' => ':attribute không được để trống',
            'email.min' => ':attribute tối thiểu 4 kí tự',
            'email.max' => ':attribute tối đa 32 kí tự',
            'email.email' => ':attribute không đúng định dạng',
        ];

        $validator = Validator::make($request->input(),$rule,$customMessage);
        if ($validator->fails()){
			return redirect('Forgot')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();

            $user = DB::table('users')
                    ->Where('email', '=', $data['email'])
                    ->get()->first();
            if($user !== null)
            {
                try{
                    // $code = strtoupper(bin2hex(random_bytes(4)));
                    $hashCode = md5($user->password);
                    $details = [
                        'title' => "Reset tài khoản",
                        'reset' => "",
                        'link' => "https://ecommerce-18ck.herokuapp.com/Reset?id=$user->id&hashCode=$hashCode"
                    ];
    
                    \Mail::to($data['email'])->send(new \App\Mail\MyTestMail($details));
    
                    return redirect('Forgot')->with('status',"Link reset tài khoản đã được gửi đến {$data['email']}");
    
                }catch(Exception $e){
                    return redirect('Forgot')->with('failed',"operation failed");
                }
            }
            else
            {
                return redirect('Forgot')->with('status',"{$data['email']} chưa đăng ký tài khoản");
            }
        }
    }

    public function reset(Request $res)
    {
        return view('Users.ResetPassword');
    }

    public function resetAccount(Request $res)
    {
        $rule = [
            'pwd' => 'required|string|min:4|max:32',
            'pwd_confirm' => 'required|string|min:4|max:255|required_with:pwd|same:pwd',
        ];
        $customMessage = [
            // Mật khẩu
            'pwd.required' => ':attribute không được để trống',
            'pwd.min' => ':attribute tối thiểu 4 kí tự',
            'pwd.max' => ':attribute tối đa 32 kí tự',
            // Mật khẩu xác nhận
            'pwd_confirm.required' => ':attribute không được để trống',
            'pwd_confirm.min' => ':attribute tối thiểu 4 kí tự',
            'pwd_confirm.max' => ':attribute tối đa 32 kí tự',
            'pwd_confirm.required_with' => ':attribute không khớp',
            'pwd_confirm.same' => ':attribute không khớp',
        ];

        $validator = Validator::make($res->all(),$rule,$customMessage);
        if ($validator->fails()){
			return redirect('ResetPassword')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $res->input();

            $user = DB::table('users')
                ->where('id', '=', session()->get('id_reset'))
                ->get()->first();

            $hashCode = md5($user->password);

            if (session()->get('code_reset') == $hashCode)
            {
                $newPassword = password_hash($data['pwd'], PASSWORD_DEFAULT);
                //update lại password
                DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => $newPassword]);
                return redirect('Active')->with('status',"Reset tài khoản thành công");
            }else{
                return redirect('Active')->with('status', "Link đã hết hạn");
            }
        }

        
        
        
    }
}