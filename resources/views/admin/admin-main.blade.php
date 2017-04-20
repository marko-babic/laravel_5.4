@extends('nav.admin')

@section('admin_main')
    <div class="news">
        <div class="title"> notifications</div>
        <div class="content">
            <ul>
                @foreach($unread_notifications as $notification)
                    <li data-notification="{{$notification->id}}">
                        @php
                            $view = 'notifications.'.last(explode('\\',$notification["type"]));
                        @endphp
                        @include($view)
                        <span class="glyphicon glyphicon-ok note-read" title="Mark as read"></span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection