<script>
    var ajax_url = {
        vote: "{{route('vote.store')}}"
    };

            @if(Auth::Guest())
    var isLogged = false;
            @else
    var isLogged = true;
    @endif
</script>