@extends('main')

@section('body')
        <div class="row">
            <div class="col-md-7 main-wrap">
                <!-- to be changed soon -->
                @yield('content')
                @yield('content_main')
            </div>
            <div class="col-md-5 sidebar-wrap">
                @include('nav.sidebar')
            </div>
        </div>
@endsection