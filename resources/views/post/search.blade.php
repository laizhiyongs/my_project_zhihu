{{--文章搜索页--}}
@extends('layout.main')
@section('content')
    <div class="alert alert-success" role="alert">
        下面是搜索"{{$query}}"出现的文章，共{{$posts->total()}}条
    </div>
    <div class="col-sm-8 blog-main">
        @foreach($posts as $vo)
            <div class="blog-post">
                <h2 class="blog-post-title"><a
                            href="/posts/{{$vo->id}}">{!! str_replace($query,'<span style="color:red" >' . $query . '</span>',$vo->title) !!}</a>
                </h2>
                <p class="blog-post-meta">{{$vo->created_at->toFormattedDateString()}} <a
                            href="/user/{{$vo->user->id}}">{{$vo->user->name}}</a></p>

                {!! str_replace($query,'<span style="color:red" >' . $query . '</span>', str_limit($vo->content,200,'...') )  !!}
                <p class="blog-post-meta">赞 {{$vo->zans_count}} | 评论 {{$vo->comments_count}}</p>
            </div>
        @endforeach
        {{--分页--}}
        {{$posts->links()}}

    </div><!-- /.blog-main -->

@endsection()
