<ul>
    @foreach($notifications as $notification)
        @php
            Auth::User()->notifications()->find($notification->id)->markAsRead();
        @endphp
        @include($notification["view"])
    @endforeach
</ul>