<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * 专题页面
     */
    public function show(Topic $topic){
        //专题的文章数
        $topic = Topic::withCount(['postTopics'])->find($topic->id);
        //专题的文章列表[倒叙排前10个]
        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();

        //属于我的文章但是没有投稿
        $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        $title = '专题';
        return view('topic.show', compact('title','topic', 'posts', 'myposts'));
    }

    /**
     * 投稿
     * @param Topic $topic
     */
    public function submit(Topic $topic){

    }

}
