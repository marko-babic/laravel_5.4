<script>
    var ajax_url = {
        vote: "{{route('vote')}}",
        login: "{{route('login')}}"
    };

            @if(Auth::guest())
    var isLogged = false;
            @else
    var isLogged = true;
    @endif
</script>