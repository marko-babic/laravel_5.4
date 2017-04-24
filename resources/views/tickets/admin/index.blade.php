@extends('nav.admin')

@section('admin_main')
    <div class="element text-center"> <b>TICKETS</b> </div>
    <table class="table tickets" width="100%">
        <thead>
            <tr>
                <td> Topic </td>
                <td> User </td>
                <td> Created </td>
                <td> Status </td>
                <td> Actions </td>
            </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>
                    {{$ticket->topic->text}}
                </td>
                <td>
                    {{$ticket->user->login}}
                </td>
                <td>
                    {{$ticket->created_at->diffForHumans()}}
                </td>
                <td>
                    <span class="{{Misc::ticketColor($ticket->status->text)}}">{{$ticket->status->text}}</span>
                </td>
                <td>
                    <a href="{{route('ticket.edit',['id' => $ticket->id])}}" target="_blank" title="Review/reply ticket"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="javascript:checkDelete({{$ticket->id}});" title="Delete ticket"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection