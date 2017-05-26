@extends('main')

@section('body')
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-8">
            <a href="{{route('dashboard')}}"> <button class="btn btn-primary">Dashboard </button></a>
        </div>
        <div class="col-md-4">
            <div class="quick">
                <a href="{{route('posts.create')}}"> Quick info </a>
            </div>
        </div>
    </div>
@endsection