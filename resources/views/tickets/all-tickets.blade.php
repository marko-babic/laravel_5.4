@if(count($info["ticket"]))
    <table class="table" width="100%">
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
                <td> {{$ticket->status->text}} </td>
                <td> {{$ticket->created_at->diffForHumans()}} </td>
                <td> <a href="{{route('ticket.edit', ['id' => $ticket->id])}}" target="_blank" title="Click to check ticket">Check </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif