@if(count($slike))
    <div class="container" style="margin-top: 20px; padding:15px;">
        <div class="slider center">
            @foreach($slike as $slika)
                @if($slika->approved == 1)
                    <div class="thumbnail">
                        <img data-lazy="{{ asset('/storage/screenshots/'.$slika->path) }}">
                        <div class="caption text-center" style="color: white;">
                            Author: {{$slika->user->displayname}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
