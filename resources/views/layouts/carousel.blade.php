@if(count($carousel))
    <div class="container" style="margin-top: 20px; padding:15px;">
        <div class="slider center">
            @foreach($carousel as $picture)
                @if($picture->approved)
                    <div class="thumbnail">
                        <img id="{{str_random(20)}}" data-id="{{$picture->id}}" data-pos="carousel" class="screen"
                             data-lazy="{{ asset('/storage/screenshots_thumbnail/'.$picture->path) }}"
                             title="{{$picture->description}}">
                        <div class="caption text-center" style="color: white;">
                            <div class="pull-left">
                                <span id="img_vote_count{{$picture->id}}">{{$picture->votes}}</span>
                                <span class="glyphicon glyphicon-heart" title="Votes"> </span>
                            </div>
                            Author: {{$picture->user->displayname}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="text-center">
            @if(!Auth::guest())
                <?php
                $votes = \App\Vote::votesleft();
                ?>
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
