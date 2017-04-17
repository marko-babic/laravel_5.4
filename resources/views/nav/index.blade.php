@extends('main')

@section('body')
        <div class="row" style="padding: 10px 0 10px 10px;">
            <div class="col-md-7">
                @yield('content')
            </div>
            <div class="col-md-5">
                <div class="stats-bg">
                    <div class="stats active"><a class="stats-link" data-toggle="pill" href="#home"> RATES </a></div>
                    <div class="stats"><a class="stats-link" data-toggle="pill" href="#menu1"> SERVER INFO </a></div>
                    <div class="stats"><a class="stats-link" data-toggle="pill" href="#menu2"> SERVER STATUS </a></div>
                </div>
                <div class="tab-content element">
                    <div id="home" class="tab-pane fade in active " style="padding-left: 30px;">
                        <p>XP: 15x <br>
                            QUEST XP: 15x <br>
                            SP: 15x <br>
                            ADENA: 15x <br>
                            QUEST ADENA: 15x <br>
                            SEALSTONES: 15x <br>
                            ADENA DROP RATE: 70% <br>
                            DROP: 15x <br>
                            SPOIL: <br>
                            Materials: 10x amount, 1x chance <br>
                            Others: 10x chance, 1x amount
                        </p>
                    </div>
                    <div id="menu1" class="tab-pane fade text-center">
                        <p>   <b>CPU</b>: Intel Xeon E5-1620v2 <br>
                            <b>Cores:</b> 4 <br>
                            <b>RAM:</b> 16 GB DDR4 <br>
                            <b>Disk:</b> 200GB SSD <br>
                            <b>Network:</b> 1 Gbps <br>
                            <b>Anti ddos:</b> 400 GBs max</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <p>
                            Login server : ONLINE <br>
                            Game server : ONLINE <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                @yield('content_main')
            </div>
            <div class="col-md-5">
                <br><br>
                @if(Auth::guest())
                    <a href="{{route('register')}}"> <div class="quick"><span class="glyphicon glyphicon-chevron-right"> </span> Registration </div></a>
                @endif
                <div class="quick" data-toggle="collapse" data-target="#download"> <span class="glyphicon glyphicon-chevron-down"> </span> Download </div>
                <div id="download" class="collapse drops" style="padding: 15px;">
                    <ul> <a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 1 </a></ul>
                    <ul> <a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 2 </a></ul>
                    <ul> <a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 3 </a></ul>
                </div>
                <div class="quick" data-toggle="collapse" data-target="#vote"> <span class="glyphicon glyphicon-chevron-down"> </span> Vote </div>
                <div id="vote" class="collapse drops" style="padding: 15px;">
                    <ul> <a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 1 </a></ul>
                    <ul> <a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 2 </a></ul>
                </div>
                <br><br>
                <div class="news">
                    <div class="title"> Top pvp of the month </div>
                    <div class="content">
                        <table class="table borderless" style="color: white;">
                            <thead>
                            <tr class="text-center">
                                <td> Place </td>
                                <td> Name </td>
                                <td> Kills </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td> 1. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 2. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 1. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 2. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 1. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 2. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 1. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 2. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            <tr class="text-center">
                                <td> 1. </td>
                                <td> Maki </td>
                                <td> 222 </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection