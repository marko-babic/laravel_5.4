@extends('admin.dashboard')

@section('admin_main')
    <div class="admin-main">
            Pending screenshots
            <hr>
        @foreach($screenshots as $screen)
            <img data-id="{{$screen->id}}" data-pos="screen" class="screen img-thumbnail" id="{{str_random(20)}}"
                 src="{{ asset('/storage/screenshots_thumbnail/'.$screen->path) }}"
                 title="{{$screen->user->login}} | {{$screen->description}}">
        @endforeach
    </div>

    <div id="scr-modal" class="modal">
        <span class="close" onclick="document.getElementById('scr-modal').style.display='none'">&times;</span>

        <img class="modal-content" id="img01">

        <div id="caption">
        </div>
    </div>
@endsection