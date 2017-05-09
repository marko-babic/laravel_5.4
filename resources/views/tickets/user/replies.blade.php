@extends('nav.index')

@section('content')
    <div class="element ticket-header">
        <ul>
            <li><b>SUBJECT:</b> {{$ticket->topic->text}} </li>
            <li><b>SUBMITTED:</b>  {{$ticket->created_at->diffForHumans()}} </li>
            <li><b>TICKET STATUS:</b> <span class="{{Misc::ticketColor($ticket->status->text)}}">{{$ticket->status->text}}</span> </li>
            <li><b>TICKET ID:</b> {{$ticket->display_id}} </li>
        </ul>
    </div>
    <hr>
    <div class="element">
        <b> CONTENT </b>
        <p class="ticket-question">
            {{$ticket->content}}
        </p>
    </div>
        @foreach($ticket->replies as $reply)
            <div class="element">
                <u> Date : {{$reply->created_at}} </u>
                <p class="ticket-text"> {{$reply->content}} </p>
                <p class="text-right"> by: {{$reply->user->web->displayname}} </p>
            </div>
        @endforeach
    <hr>
    @if($cansubmit)
        @include('tickets.user.reply-form')
    @endif
@endsection
