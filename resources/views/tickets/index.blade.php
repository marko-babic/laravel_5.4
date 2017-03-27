@extends('nav.admin')

@section('admin_main')
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-2">
            Topic
        </div>
        <div class="col-md-2">
            Content
        </div>
        <div class="col-md-2">
            User
        </div>
        <div class="col-md-2">
            Created
        </div>
        <div class="col-md-2">
            Status
        </div>
        <div class="col-md-2">
            Actions
        </div>
    </div>
    @foreach($tickets as $ticket)
        <div class="row news">
            <div class="col-md-2">
                {{$ticket->topic->text}}
            </div>
            <div class="col-md-2">
                {{$ticket->content}}
            </div>
            <div class="col-md-2">
                {{$ticket->user->login}}
            </div>
            <div class="col-md-2">
                {{$ticket->created_at}}
            </div>
            <div class="col-md-2">
                {{$ticket->status->text}}
            </div>
            <div class="col-md-2">
                <a href="ticket/{{$ticket->id}}/edit" target="_blank"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:checkDelete({{$ticket->id}});"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
         </div>
    @endforeach
@endsection