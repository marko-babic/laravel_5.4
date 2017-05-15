<div class="row">
    <ul class="navbar">
        @foreach($navigationBar as $navBar)
            @if(isset($navActive) && $navBar->shortcode == $navActive)
                <li class="active">
            @else
                <li>
            @endif

            <a href="{{route('nav', ['nav' => $navBar->shortcode])}}">{{$navBar->navbar}}</a>
            @if($navBar->shortcode === 'home' && Auth::check())
                @php
                    $newNotifications = count(Auth::User()->unreadNotifications);
                @endphp
                @if($newNotifications > 0)
                <span class="badge" title="{{$newNotifications}} new notifications"> {{$newNotifications}} </span>
                @endif
            @endif
            </li>
        @endforeach
        @if(Auth::check())
            <li class="pull-right">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> LOGOUT  </a>
            </li>
            <form class="hidden" id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form>
        @endif
    </ul>
    <hr>
</div>