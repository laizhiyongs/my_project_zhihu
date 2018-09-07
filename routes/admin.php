<?php
/**
 * User: lzy <1029460965@qq.com>
 * Date: 2018/8/30
 * Time: 22:56
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){

    //登录
    Route::match(['post', 'get'], 'login', 'LoginController@index');

    //登出
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => 'auth:admin'], function (){
        //后台首页
        Route::get('home','HomeController@index');

        //用户列表
        Route::get('users', 'UserController@index');

        //用户添加
        Route::match(['get','post'], 'users/create','UserController@create');


    });




});
