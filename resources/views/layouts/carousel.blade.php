@if(count($carousel))
    <div class="container carousel-wrap">
        <div class="slider center">
            @foreach($carousel as $picture)
                    <div class="thumbnail">
                        <img id="{{str_random(20)}}" data-id="{{$picture->id}}" data-pos="carousel" class="screen"
                             data-lazy="{{ asset('/storage/screenshots_thumbnail/'.$picture->path) }}"
                             title="{{$picture->description}}">
                        <div class="caption text-center">
                            <div class="pull-left">
                                <span id="img_vote_count{{$picture->id}}">{{$picture->votes}}</span>
                                <span class="glyphicon glyphicon-heart" title="Votes"> </span>
                            </div>
                            Author: {{$picture->user->web->displayname}}
                        </div>
                    </div>
            @endforeach
        </div>
        <div class="text-center">
            @if($votes)
                You have <span id="vote_count"> {{$votes["left"]}}</span> votes left
                @if(isset($votes["next"]))
                    | Next vote available in {{$votes["next"]}} minutes.
                @endif
            @endif
        </div>
    </div>
@endif

<!-- The Modal -->
<div id="scr-modal" class="modal">
    <span class="close" onclick="document.getElementById('scr-modal').style.display='none'">&times;</span>

    <img class="modal-content" id="img01">

    <div id="caption">
    </div>
</div>
