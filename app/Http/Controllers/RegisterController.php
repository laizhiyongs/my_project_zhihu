<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 注册页面
     */
    public function index(Request $request){
        if ($request->getMethod() == 'GET'){
            $title = '用户注册';
            return view('register/index', compact('title'));
        }
        //注册行为
        if ($request->method() == 'POST'){

            //验证
            $this->validate(request(),[
                'name' => 'required|min:3|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:5|max:16|confirmed',

            ],[],[
                'name' => '用户名',
                'email' => '邮箱',
                'password' => '密码',
            ]);

            //业务逻辑
            $data = request()->all();
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            //渲染
            return redirect('/login');

        }

    }





}
