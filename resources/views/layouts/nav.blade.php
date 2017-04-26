<div class="row">
    <ul class="navbar">
        <li><a href="{{ route('index')}}"> Home </a></li>
        <li><a href="{{ route('start')}}"> Start </a></li>
        <li><a href="{{ route('rules')}}"> Rules </a></li>
        <li><a href="{{ route('faq')}}"> Faq </a></li>
        <li>
            <a href="{{ route('login')}}"> Account
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
            </a>
        </li>
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