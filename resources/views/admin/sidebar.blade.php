<div class="admin-sidebar">
    <ul>
        <li> <a href="{{route('users.index')}}"> Users </a></li>
        <li>
            <a href="{{route('tickets.index')}}"> Tickets </a>
            @if($unansweredTickets > 0)
            <span class="badge" title="Unanswered tickets"> {{$unansweredTickets}} </span>
            @endif
        </li>
        <li>
            <a href="{{route('screenshots.index')}}"> Screenshots </a>
            @if($newScreenshots > 0)
            <span class="badge" title="Unchecked screenshots"> {{$newScreenshots}} </span>
            @endif
        </li>
        <li> <a href="{{route('cms')}}"> CMS </a></li>
        <li> <a href=""> Server stats </a></li>
        <li> <a href="{{route('index')}}"> Main site </a></li>
    </ul>
    @include('admin.notifications')
</div>