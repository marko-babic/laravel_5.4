@extends('nav.index')

@section('content')
    <div class="element ticket-header">
        <ul>
            <li><b>SUBJECT:</b> {{$info["ticket"]->topic->text}} </li>
            <li><b>SUBMITTED:</b>  {{$info["ticket"]->created_at->diffForHumans()}} </li>
            <li><b>TICKET STATUS:</b> <span style="color: green">{{$info["ticket"]->status->text}}</span> </li>
            <li><b>TICKET ID:</b> {{strtoupper(str_random(10))}} </li>
        </ul>
    </div>
    <hr>
    <div class="element">
        <b> QUESTION </b>
        <p class="ticket-question">
            {{$info["ticket"]->content}}
        </p>
    </div>
        @foreach($info["ticket"]->replies as $reply)
            <div class="element">
                <u> Date : {{$reply->created_at}} </u> <br><br>
                <p>    {{$reply->content}} </p>
            </div>
        @endforeach
    <hr>
    @if($info["cansubmit"])
        @include('tickets.reply-form')
    @endif
@endsection
