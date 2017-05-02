    <li>
        @if ($notification->data["ss_status"] == 1)
            Screenshot "{{$notification->data["ss_description"]}}" was approved. Thank you
            for your contribution ! <br>
            {{$notification->created_at->diffForHumans()}}
            <span class="glyphicon glyphicon-ok" style="color: green;"></span>
        @elseif ($notification->data["ss_status"] == 2)
            We're sorry, screenshot "{{$notification->data["ss_description"]}}" was denied.
            Make sure you follow the <a href="{{url('rules')}}"
                                        target="_blank">rules. </a><br>
            {{$notification->created_at->diffForHumans()}}
            <span class="glyphicon glyphicon-remove" style="color: red;"></span>
        @endif
    </li>