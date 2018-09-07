<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 用户管理页
     */
    public function index()
    {
        $users = AdminUser::paginate(10);


        $title = '用户管理';
        return view('admin.user.index', compact('title', 'users'));
    }

    /**
     * 用户添加
     */
    public function create()
    {

        if (\request()->method() == 'GET') {

            $title = '用户添加';
            return view('admin.user.create', compact('title'));
        }

        if (\request()->method() == 'POST') {
            //验证
            self::validate(\request(), [
                'name' => 'required|min:2|unique:admin_users',
                'password' => 'required|min:6|max:16',
            ], [], [
                'name' => '用户名',
                'password' => '密码'
            ]);
            //逻辑
            $name = \request()->get('name');
            $password = bcrypt(\request()->get('password'));
            AdminUser::firstOrCreate(compact('name', 'password'));
            //渲染
            return redirect('/admin/users');
        }

    }


}
