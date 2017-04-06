<div class="row">
    <div class="navbar">
        <div class="link"> <a href="{{ route('index')}}">HOME</a></div>
        <div class="link"> <a href="{{ route('start')}}">START</a> </div>
        <div class="link"> <a href="{{ route('rules')}}">RULES</a></div>
        <div class="link"> <a href="{{ route('faq')}}">FAQ</a> </div>
        <div class="link">
            <a href="{{ route('login')}}">ACCOUNT
                @if(Auth::check())
                    @php
                        $new_count = count(Auth::User()->unreadNotifications);
                    @endphp
                    @if($new_count > 0)
                        <span class="badge" title="{{$new_count}} new notifications"
                              style="background-color: white; color: red; font-weight: bold">
                        {{$new_count}}
                    </span>
                    @endif
                @endif
            </a>
        </div>
        @if(Auth::check())
            <div class="link">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> LOGOUT  </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
    </div>
    <hr>
</div>