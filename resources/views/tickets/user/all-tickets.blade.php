@if(count($info["ticket"]))
    <table class="table tickets" width="100%">
        <thead>
            <tr class="text-center">
                <td > Subject </td>
                <td> Status </td>
                <td> Submitted </td>
                <td> </td>
            </tr>
        </thead>
        <tbody>
        @foreach($info["ticket"] as $ticket)
            <tr class="text-center">
                <td> {{$ticket->topic->text}} </td>
                <td> <span class="{{Misc::ticketColor($ticket->status->text)}}">{{$ticket->status->text}} </span></td>
                <td> {{$ticket->created_at->diffForHumans()}} </td>
                <td> <a href="{{route('ticket.edit', ['id' => $ticket->id])}}" target="_blank" title="Click to check ticket">Review </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif