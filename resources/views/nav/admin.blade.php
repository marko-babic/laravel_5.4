@extends('main')

@section('body')
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-8">
            @yield('admin_main')
        </div>
        <div class="col-md-4">
            <div class="quick">
                <a href="{{route('posts.create')}}"> New Post </a>
            </div>
            <div class="news">
                <div class="quick" onclick="getPosts()">
                    <span class="glyphicon glyphicon-chevron-down"> </span> Edit Posts
                </div>
                <div id="displayposts" class="content">a</div>
            </div>
            <div class="quick"> <a href="{{route('ticket.index')}}">Tickets</a></div>
            <div class="quick"> <a href="{{route('screenshot.index')}}">Screenshots</a></div>
        </div>
    </div>
@endsection

@section('admin_scripts')
    @include('js.admin-variables')
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
@endsection