@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $vo)
            <li>{{$vo}}</li>
        @endforeach
    </div>
@endif