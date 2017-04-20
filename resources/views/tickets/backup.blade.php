@if(count($info["ticket"]))
    @include('tickets.replies')
    @if($info["ticket"]["cansubmitreply"])
        @include('tickets.reply-form')
    @endif
@else
    @if($info["cansubmit"])
        @include('tickets.form')
    @else
        Only one ticket per (x) days.
    @endif
@endif