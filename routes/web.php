<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//用户模块

//注册页面
Route::match(['post', 'get'], '/register', 'RegisterController@index');

//登录页面
Route::match(['get', 'post'], '/login', 'LoginController@index')->name('login');

Route::group(['middleware' => 'auth:web'], function () {
    //注销
    Route::get('/logout', 'LoginController@logout');

    //个人设置页面
    Route::match(['post', 'get'], '/user/me/setting', 'UserController@setting');

    //文章列表页
    Route::get('/posts', 'PostController@index');

    //创建文章展示
    Route::get('/posts/create', 'PostController@create');

    //搜索页
    Route::get('/posts/search', 'PostController@search');

    //文章详情页
    Route::get('/posts/{post}', 'PostController@show'); //->where('post','\d+');

    //创建文章的逻辑
    Route::post('/posts', 'PostController@store');

    //编辑文章展示
    Route::get('/posts/{post}/edit', 'PostController@edit');

    //编辑文章逻辑
    Route::put('/posts/{post}', 'PostController@update');

    //删除文章
    Route::get('/posts/{post}/delete', 'PostController@delete');

    //图片上传
    Route::post('/posts/image/upload', 'PostController@imageUpload');

    //评论添加
    Route::post('/posts/{post}/comment', 'PostController@comment');

    //点赞
    Route::get('/posts/{post}/zan', 'PostController@zan');

    //取消赞
    Route::get('/posts/{post}/unzan', 'PostController@unzan');

    //个人中心
    Route::get('/user/{user}', 'UserController@show');
    //关注某人
    Route::post('/user/{user}/fan', 'UserController@fan');
    //取消关注某人
    Route::post('/user/{user}/unfan', 'UserController@unfan');

    //专题详情
    Route::get('/topic/{topic}', 'TopicController@show');
    //投稿
    Route::post('/topic/{topic}/submit', 'TopicController@submit');
});



include_once ('admin.php');
