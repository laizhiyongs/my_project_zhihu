<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 首页
     */
    public function index(){

        $title = '个人中心';
        return view('admin.home.index', compact('title'));
    }

}
