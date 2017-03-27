@extends('nav.index')

@section('content_main')
    @foreach($posts as $post)
        <div class="news">
            <div class="title"> {!! $post->title !!}</div>
            <div class="content"> {!! $post->content !!} </div>
            <div class="extra"> {{$post->created_at->format('m/d/Y')}}</div>
        </div>
    @endforeach
    <div class="news text-center">
        {{ $posts->links() }}
    </div>
@endsection

@section('content')
    <img class="img-thumbnail" src="{{asset('/css/slika.jpg')}}" style="width: 100%; margin: 30px 0 70px 0;">
@endsection