@extends('nav.admin')

@section('admin_main')
    @foreach($screenshots as $screen)
        <img data-id="{{$screen->id}}" data-pos="screen" class="screen img-thumbnail" id="{{str_random(20)}}"
             src="{{ asset('/storage/screenshots_thumbnail/'.$screen->path) }}"
             title="{{$screen->user->login}} | {{$screen->description}}">
    @endforeach
@endsection