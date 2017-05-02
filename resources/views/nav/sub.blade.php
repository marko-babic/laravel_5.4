@extends('nav.index')

@section('content_main')
    @if(isset($post))
        {!! $post->content !!}
    @endif
@endsection