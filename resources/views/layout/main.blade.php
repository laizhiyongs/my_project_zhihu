{{--头部--}}
@include('layout.header')
{{--导航栏--}}
@include('layout.nav')


<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">

        {{--中间栏--}}
        @yield('content')

        {{--右边栏--}}
        @include('layout.sidebar')


    </div>    </div><!-- /.row -->
</div><!-- /.container -->

{{--尾部--}}
@include('layout.footer')

