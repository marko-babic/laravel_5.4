@if(count($unreadNotifications))
    <div id="notification-placeholder">
        <ul>
            @foreach($unreadNotifications as $notification)
                <li data-notification="{{$notification->id}}">
                    @include($notification["view"])
                    <span class="glyphicon glyphicon-ok note-read" title="Mark as read"></span>
                </li>
            @endforeach
            <li>
                <span id="markall">Mark all as read</span>
            </li>
        </ul>
    </div>
@endif