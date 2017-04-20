New ticket was submitted  by {{$notification->data["login"]}} , {{$notification->created_at->diffForHumans()}}.
<a href="{{$notification->data["url"]}}" target="_blank">[check]</a>
