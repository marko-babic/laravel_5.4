@extends('nav.admin')

@section('admin_main')
    <div class="news">
        <div class="title"> notifications</div>
        <div class="content">
            <ul>
                @foreach($unread_notifications as $notification)
                    <li data-notification="{{$notification->id}}">
                        {{$notification->data["text"]}} by {{$notification->data["login"]}} ,
                        {{$notification->created_at->diffForHumans()}}
                        <a href="{{$notification->data["url"]}}" target="_blank">[check]</a>
                        <span class="glyphicon glyphicon-ok note-read" title="Mark as read"></span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection