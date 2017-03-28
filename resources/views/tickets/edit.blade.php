@extends('nav.admin')
<?php $status = [1 => "Active", 2 => "Closed", 3 => "Solved"];?>
@section('admin_main')
    <div style="margin: 0 0 20px 20px;">
        Ticket topic:
        <ul>{{  $info->topic->text}} </ul>
        Text:
        <ul> {{ $info->content }}</ul>
        <ul>
            @foreach($info->replies as $reply)
                <div class="element">
                    <div> Date : {{$reply->created_at}} </div>
                    <div>    {{$reply->content}} </div>
                </div>
            @endforeach
        </ul>
        Submitted:
        <ul> {{$info->created_at}} </ul>
        Ticket status:

        <form action="{{route('ticket_reply',["id" => $info->id])}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <select class="form-control" name="status">
                    @foreach($status as $key => $option)
                        @if($info->status_id == $key)
                            <option selected="selected" value="{{$key}}"> {{$option}} </option>
                        @else
                            <option value="{{$key}}"> {{$option}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea rows="10" class="form-control" name="content" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-default">Reply</button>
            </div>
        </form>
    </div>
@endsection