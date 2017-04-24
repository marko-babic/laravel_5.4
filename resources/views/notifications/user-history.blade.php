<ul>
    @foreach($info["notifications"] as $notification)
        @php
            $view = 'notifications.'.last(explode('\\',$notification["type"]));
            Auth::User()->notifications()->find($notification->id)->markAsRead();
        @endphp
        @include($view)
    @endforeach
</ul>