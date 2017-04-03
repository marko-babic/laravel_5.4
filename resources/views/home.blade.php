@extends('nav.index')

@section('content')
    @if(session('ticket_message'))
        <div class="alert alert-success">
            {{session('ticket_message')}}
        </div>
    @endif

    @if(session('screenshot'))
        <div class="alert alert-success">
            {{session('screenshot')}}
        </div>
    @endif


    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
@endsection

@section('content_main')
        <div class="row" style="margin-left: 5px;">
            <div class="news">
                <div class="title cp" data-toggle="collapse" data-target="#changepass"> <span class="glyphicon glyphicon-chevron-down"> </span> Change password </div>
                <div id="changepass" class="collapse drops content">
                    <ul>
                        <li> If you wish to change password, logout, and click "Forgot your password?". </li>
                        <li> Confirmation link will be sent to {{Auth::user()->email}}.</li>
                        <li> Click on the link provided in email. </li>
                        <li> Change password. </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 5px;">
            <div class="news">
                <div class="title cp" data-toggle="collapse" data-target="#uploadfile"> <span class="glyphicon glyphicon-chevron-down"> </span> Upload cool screenshot </div>
                <div id="uploadfile" class="collapse drops content">
                    <div style="padding: 20px 40px 20px 40px;">
                        @if($info["screenshot"])
                            @include('file.form')
                        @else
                            <p>Last upload : {{$info["screenshot_time"]->created_at->diffForHumans()}} </p>
                            <p>Next possible in
                                : {{$info["screenshot_time"]->created_at->addHours(config('custom.screenshot_limit'))->diffForHumans()}} </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 5px;">
            <div class="news">
                <div class="title cp" data-toggle="collapse" data-target="#submitticket"> <span class="glyphicon glyphicon-chevron-down"> </span> Submit / review ticket </div>
                @if(session('ticket_message'))
                    <div id="submitticket" class="collapse drops content in" style="padding-left: 40px;">
                @else
                    <div id="submitticket" class="collapse drops content" style="padding: 40px;">
                @endif
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
                    </div>
                </div>
        </div>
        <div class="row" style="margin-left: 5px;">
            <div class="news">
                <div class="title cp"> <span class="glyphicon glyphicon-chevron-down"> </span> Vote / Claim reward</div>
            </div>
        </div>
@endsection
