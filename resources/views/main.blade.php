<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <div style="margin: 450px 0 100px 0">
            <div class="container">
                @include('layouts.nav')
            </div>
            <div class="container">
                @yield('body')
            </div>

            @include('layouts.carousel')

            @include('layouts.footer')
        </div>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>

@yield('admin_scripts')
@include('js.variables')
<script src="{{ asset('js/functions.js') }}"></script>

<script type="text/javascript">
    $(document).on('ready', function () {
        $('.center').slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 1,
            variableWidth: true,
            variableHeight: true
        });
    });
</script>

    <script>
        @if(Auth::check())
            @if(Auth::user()->isAdmin())
                Echo.private('notify-admin')
                    .listen('.L2.Events.NewScreenshot', (e) => updateNotifications(e))
            .listen('.L2.Events.NewTicket', (e) => updateNotifications(e))
            .listen('.L2.Events.NewTicketReply', (e) => updateNotifications(e));
        @else
            Echo.private('notify-user.{{Auth::id()}}')
                .listen('.L2.Events.CheckedScreenshot', (e) => updateNotifications(e))
                .listen('.L2.Events.NewTicketReply', (e) => updateNotifications(e));
        @endif

         function updateNotifications(data) {
             let badge = $('#badge');
             let test = parseInt(badge.html());

             if(isNaN(test)) {
             badge.addClass('badge');
             }
             badge.html(data.number);
         }
        @endif
    </script>
</body>
</html>