<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 文章列表页
     */
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(10);
        $title = '文章列表';
        return view('post/index', compact('posts', 'title'));
    }


    /**
     * 文章详情页
     */
    public function show(Post $post){
        $post->load('comments');
        $title = '文章详情';
        return view('post/show', compact('title','post'));
    }

    /**
     * 文章创建展示页面
     */
    public function create(){
        $title = '创建文章';
        return view('post/create', compact('title'));
    }

    /**
     * 文章创建逻辑
     */
    public function store(){
        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        Post::create($params);

        //渲染
        return redirect('/posts');

    }


    /**
     * 文章编辑展示页
     */
    public function edit(Post $post){

        $title = '编辑文章';
        return view('post/edit', compact('title','post'));
    }

    /**
     * 文章编辑提交
     */
    public function update(Post $post){
        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update', $post);

        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        //渲染
        return redirect("/posts/{$post->id}");
    }

    /**
     * 文章删除
     */
    public function delete(Post $post){
        // Todo 权限验证
        $this->authorize('delete', $post);
        $post->delete();
        return redirect("/posts");



    }


    /**
     * 文章图片上传
     */
    public function imageUpload(Request $request){

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/' . $path);

    }

    /**
     * 评论添加
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Post $post){
        //验证
        $this->validate(request(),[
            'content' => 'required|min:3'
        ],[],[
            'content' => '评论内容'
        ]);

        //逻辑
        $comment =  new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    /**
     * 点赞
     */
    public function zan(Post $post){
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    /**
     * 取消赞
     */
    public function unzan(Post $post){
        $post->zan(\Auth::id())->delete();
        return back();

    }

    /**
     * 搜索
     */
    public function search(){
        //验证
        $this->validate(request(),[
            'query' => 'required'
        ],[],[
            'query' => '查询条件'
        ]);
        $query = request()->get('query');
        $posts = Post::search($query)->paginate(10);


        //渲染
        $title = '文章搜索';
        return view('post/search', compact('title','posts','query'));
    }



}
