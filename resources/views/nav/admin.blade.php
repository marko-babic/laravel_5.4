@extends('main')

@section('body')
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-8">
            @yield('admin_main')
        </div>
        <div class="col-md-4">
            <div class="quick"> <a href="{{route('posts.create')}}">New Post </a></div>
            <div class="news">
                <div class="quick" onclick="getPosts()"> <span class="glyphicon glyphicon-chevron-down"> </span> Edit Posts</div>
                <div id="displayposts" class="content" style="display:none;"></div>
            </div>
            <div class="quick"> <a href="{{route('ticket.index')}}">Tickets</a></div>
            <div class="quick"> <a href="{{route('screenshot.index')}}">Screenshots</a></div>
        </div>
    </div>
@endsection

@section('admin_scripts')
<script>
    var t_del = "{{url('ticket')}}";
    var posts_js = "{{route('posts.index')}}" ;
    var approve = "{{url('screenshot')}}" ;
    var r_post = "{{url('posts')}}" ;
</script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/jquery-te-1.4.0.min.js') }}"></script>
@endsection

@section('admin_css')
    <link href="{{ asset('css/jquery-te-1.4.0.css') }}" rel="stylesheet">
@endsection