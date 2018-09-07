<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 启动之后执行
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //设置Schema的默认string长度
        Schema::defaultStringLength(250);

        \View::composer('layout.sidebar', function ($view){
            $topics = \App\Topic::all();
            $view->with('topics', $topics);
        });
    }

    /**
     * 启动之前执行
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
