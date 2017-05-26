@extends('admin.dashboard')

@section('admin_main')
    <div class="admin-main">
        Users
        <hr>
        <table class="table tickets">
            <thead>
            <tr>
                <td> Id </td>
                <td> Login </td>
                <td> Display name </td>
                <td> Last active </td>
                <td> Access level </td>
                <td> Email </td>
                <td> Registration date </td>
                <td> Edit </td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->id}}
                    </td>
                    <td>
                        {{$user->login}}
                    </td>
                    <td>
                        {{$user->web->displayname}}
                    </td>
                    <td>
                        {{$user->lastactive}}
                    </td>
                    <td>
                        {{$user->access_level}}
                    </td>
                    <td>
                        {{$user->web->email}}
                    </td>
                    <td>
                        {{$user->web->created_at}}
                    </td>
                    <td>
                        <a href="{{route('users.edit', ['user' => $user->id])}}" target="_blank"><span class="glyphicon glyphicon-edit" title="Edit user"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection