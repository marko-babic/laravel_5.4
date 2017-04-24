    <li>
        Your ticket was replied. <a href="{{route('ticket.edit',['id' => $notification->data["ticket_id"]])}}" target="_blank">View here.</a><br>
        {{$notification->created_at->diffForHumans()}}
        <span class="glyphicon glyphicon-ok" style="color: green;"></span>
    </li>