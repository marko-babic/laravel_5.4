@extends('nav.admin')

@section('admin_main')
    @foreach($screenshots as $screen)
        <img data-id="{{$screen->id}}" class="screen img-thumbnail" id="{{str_random(20)}}" src="{{ asset('/storage/screenshots/'.$screen->path) }}" title="{{$screen->user->login}} | {{$screen->description}}">
    @endforeach

    <!-- The Modal -->
    <div id="scr-modal" class="modal">
        <span class="close" onclick="document.getElementById('scr-modal').style.display='none'">&times;</span>

        <img class="modal-content" id="img01">

        <div id="caption">
            <span data-imgid="<?php if(isset($screen->id)) echo $screen->id;?>" id="approve" data-toggle="tooltip" title="Approve" class="glyphicon glyphicon-ok"></span>
        </div>
    </div>

@endsection