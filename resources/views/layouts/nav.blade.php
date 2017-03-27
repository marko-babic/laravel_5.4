<div class="row">
    <div class="navbar">
        <div class="link"> <a href="{{ route('index')}}">HOME</a></div>
        <div class="link"> <a href="{{ route('start')}}">START</a> </div>
        <div class="link"> <a href="{{ route('rules')}}">RULES</a></div>
        <div class="link"> <a href="{{ route('faq')}}">FAQ</a> </div>
        <div class="link"> <a href="{{ route('login')}}">ACCOUNT</a></div>
        @if(!Auth::guest())
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