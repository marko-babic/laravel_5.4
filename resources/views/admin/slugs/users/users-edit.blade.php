@extends('admin.dashboard')

@section('admin_main')
    <div class="admin-main">
        <div class="user-form">
            @if(session('userChanged'))
                <div id="ticketmessage" class="alert alert-success">
                    {{session('userChanged')}}
                </div>
            @endif
            @if(session('userChangedError'))
                <div id="ticketmessage" class="alert alert-danger">
                    {{session('userChangedError')}}
                </div>
            @endif
            <form action="{{route('users.update', ['user' => $user->id])}}" method="POST">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="form-group">
                    <label for="login" class="form-group"> Login </label>
                    <input class="form-control" type="text" id="login" name="login" value="{{$user->login}}" required>
                </div>
                <div class="form-group">
                    <label for="displayName" class="form-group"> Display name </label>
                    <input class="form-control" type="text" id="displayName" name="displayName" value="{{$user->web->displayname}}" required>
                </div>
                <div class="form-group">
                    <label for="accessLevel" class="form-group"> Access level <span class="glyphicon glyphicon-question-sign" title="-1 = ban, 0 = normal user, 1+ = admin"></span></label>
                    <input class="form-control" type="text" id="accessLevel" name="accessLevel" value="{{$user->access_level}}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-group"> Email </label>
                    <input class="form-control" type="text" id="email" name="email" value="{{$user->web->email}}" required>
                </div>
                <button type="submit" class="btn btn-default center-block">Submit</button>
            </form>
        </div>
    </div>
@endsection