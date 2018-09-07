<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * 登录页面
     */
    public function index(Request $request){
        if ($request->method() == 'GET'){

            $title = '用户登录';
            return view('login/index',compact('title'));
        }

        if ($request->method() == 'POST'){
            //验证
            $this->validate(request(),[
                'email' => 'required|email',
                'password' => 'required|min:5|max:16',
                'is_remember' => 'integer'

            ],[],[
                'email' => '邮箱',
                'password' => '密码',
            ]);
            //逻辑
            $user = request(['email','password']);
            $is_remember = request('is_remember');
            if (\Auth::attempt($user,$is_remember)){
                return redirect('/posts');
            }
            //渲染
            return Redirect::back()->withErrors('邮箱密码不匹配');
        }


    }

    /**
     * 登出
     */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


}
