<div class="row">
    <ul class="navbar">
    @foreach($navbar as $nav)
        @if(isset($nav_active) && $nav->shortcode == $nav_active)
            <li class="active">
        @else
            <li>
        @endif
            <a href="{{route('nav', ['nav' => $nav->shortcode])}}">{{$nav->navbar}}</a>
            @if($nav->shortcode == 'home')
                    @if(Auth::check())
                        @php
                            $new_count = count(Auth::User()->unreadNotifications);
                        @endphp
                        @if($new_count > 0)
                            <span class="badge" title="{{$new_count}} new notifications">
                            {{$new_count}}
                        </span>
                        @endif
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