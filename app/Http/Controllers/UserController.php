<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 个人设置页面
     */
    public function setting(Request $request)
    {
        if ($request->method() == 'GET') {
            $title = '个人设置';
            return view('user/setting', compact('title'));
        }

        if ($request->method() == 'POST') {

        }

    }

    /**
     * 个人中心页面
     */
    public function show(User $user)
    {
        //这个人的信息，包含关注、粉丝、文章数
        $user = User::withCount(['stars','fans', 'posts'])->find($user->id);
//        dd($user->attributesToArray());
        //这个人的文章列表，取创建时间最新的前10条
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        //dd($posts->toArray());

        //这个人关注的用户[关注用户的 关注、粉丝、文章数]
        $stars = $user->stars;
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars','fans', 'posts'])->get();

        //这个人被关注的粉丝用户[那些粉丝的 关注、粉丝、文章数]
        $fans = $user->fans;
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars','fans', 'posts'])->get();

        $title = '个人中心';
        return view('user/show', compact('title','user', 'posts', 'susers', 'fusers'));

    }

    /**
     * 关注某人
     */
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return show(1,'关注成功', [], 201);

    }

    /**
     * 取消关注某人
     */
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnfan($user->id);
        return show(1,'取消关注成功', [], 201);
    }


}
