@extends('main')

@section('body')
        <div class="row">
            <div class="col-md-7" style="padding: 20px 10px 20px 10px;">
                <!-- to be changed soon -->
                @yield('content')

                @yield('content_main')
            </div>
            <div class="col-md-5" style="padding-top: 15px;">
                @include('nav.sidebar')
            </div>
        </div>
@endsection