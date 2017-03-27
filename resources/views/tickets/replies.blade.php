<div>
    <p>Ticket topic: {{  $info["ticket"]->topic->text}}</p>
    <hr>
    <div class="element">
        <div>    {{ $info["ticket"]->content }} </div>
    </div>
        @foreach($info["ticket"]->replies as $reply)
            <div class="element">
                <div> Date : {{$reply->created_at}} </div>
                <div>    {{$reply->content}} </div>
            </div>
        @endforeach
    <hr>
    <p>Submitted:  {{$info["ticket"]->created_at->diffForHumans()}} </p>
    <p>Ticket status: {{$info["ticket"]->status->text}} </p>
</div>