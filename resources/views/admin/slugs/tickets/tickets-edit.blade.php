@extends('admin.dashboard')

@section('admin_main')
    <div class="admin-main">
        <div style="width: 50%">
            <div class="element ticket-header">
                <ul>
                    <li><b>SUBJECT:</b> {{$info->topic->text}} </li>
                    <li><b>SUBMITTED:</b>  {{$info->created_at->diffForHumans()}} </li>
                    <li><b>TICKET STATUS:</b> <span class="{{Misc::ticketColor($info->status->text)}}">{{$info->status->text}}</span> </li>
                    <li><b>TICKET ID:</b> {{$info->display_id}} </li>
                </ul>
            </div>
            <hr>
            <div class="element">
                <b> CONTENT </b>
                <p class="ticket-question">
                    {{$info->content}}
                </p>
            </div>
            @foreach($info->replies as $reply)
                <div class="element">
                    <u> Date : {{$reply->created_at}} </u>
                    <p class="ticket-text"> {!!$reply->content!!} </p>
                    <p class="text-right"> by: {{$reply->user->web->displayname}} </p>
                </div>
            @endforeach
            <hr>

            <div class="ticket-edit">
                Ticket status:
                <form action="{{route('ticket_reply',["id" => $info->id])}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" name="status">
                            @foreach($status as $st)
                                @if($info->status_id === $st->id)
                                    <option selected="selected" value="{{$st->id}}"> {{$st->text}} </option>
                                @else
                                    <option value="{{$st->id}}"> {{$st->text}} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea rows="10" class="form-control" name="content" id="content" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-default">Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection