<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页
     */
    public function index(){
        if(\request()->method() == 'GET'){
            $title = '登录页';
            return view('admin.login.index', compact('title'));
        }

        if(\request()->method() == 'POST'){
            //验证
            $this->validate(request(),[
                'name' => 'required|min:2',
                'password' => 'required|min:5|max:16',

            ],[],[
                'name' => '用戶名',
                'password' => '密码',
            ]);
            //逻辑
            $user = request(['name','password']);
            if (\Auth::guard('admin')->attempt($user)){
                return redirect('/admin/home');
            }
            //渲染
            return \Redirect::back()->withErrors('用戶名密码不匹配');
        }
    }

    /**
     * 登出
     */
    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

}
