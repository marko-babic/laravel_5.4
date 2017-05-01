    <div class="nav nav-tabs stats-bg">
        <ul class="stats-ul">
            <li class="stats active"><a data-toggle="tab" href="#home">RATES</a></li>
            <li class="stats"><a data-toggle="tab" href="#menu1">SERVER INFO</a></li>
            <li class="stats"><a data-toggle="tab" href="#menu2">SERVER STATUS</a></li>
        </ul>
    </div>

    <div class="tab-content element">
        <div id="home" class="tab-pane fade in active">
            <ul class="list-unstyled">
                <li> XP: 15x </li>
                <li> QUEST XP: 15x </li>
                <li> SP: 15x </li>
                <li> ADENA: 15x </li>
                <li> QUEST ADENA: 15x </li>
                <li> SEALSTONES: 15x </li>
                <li> ADENA DROP RATE: 70% </li>
                <li> DROP: 15x </li>
                <li> SPOIL: </li>
                <li> Materials: 10x amount, 1x chance </li>
                <li> Others: 10x chance, 1x amount </li>
            </ul>
        </div>
        <div id="menu1" class="tab-pane fade text-center">
            <ul class="list-unstyled">
                <li> CPU: Intel Xeon E5-1620v2 </li>
                <li> Cores: 4 </li>
                <li> RAM: 16 GB DDR4 </li>
                <li> Disk: 200GB SSD </li>
                <li> Network: 1 Gbps </li>
                <li> Anti ddos: 400 GBs max /li>
            </ul>
        </div>
        <div id="menu2" class="tab-pane fade">
            <ul class="list-unstyled">
                <li> Login server : ONLINE </li>
                <li> Game server : ONLINE </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-links">
        @if(Auth::guest())
            <a href="{{route('register')}}">
                <div class="quick">
                    <span class="glyphicon glyphicon-chevron-right"></span> Registration
                </div>
            </a>
        @endif
        <div class="quick" data-toggle="collapse" data-target="#download">
            <span class="glyphicon glyphicon-chevron-down"></span> Download
        </div>
        <div id="download" class="collapse drops">
            <ul class="list-unstyled">
                <li><a href=""><span class="glyphicon glyphicon-chevron-right"></span> Link 1 </a></li>
                <li><a href=""><span class="glyphicon glyphicon-chevron-right"></span> Link 2 </a></li>
                <li><a href=""><span class="glyphicon glyphicon-chevron-right"></span> Link 3 </a></li>
            </ul>
        </div>
        <div class="quick" data-toggle="collapse" data-target="#votes">
            <span class="glyphicon glyphicon-chevron-down"></span> Vote
        </div>
        <div id="votes" class="collapse drops">
            <ul class="list-unstyled">
                <li><a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 1 </a></li>
                <li><a href=""><span class="glyphicon glyphicon-chevron-right"> </span> Link 2 </a></li>
            </ul>
        </div>
    </div>

    <div class="news">
        <div class="title">
            Top pvp of the month
        </div>
        <div class="content">
            <table class="table borderless">
                <thead>
                <tr>
                    <td> Place </td>
                    <td> Name </td>
                    <td> Kills </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> 1. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 2. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 1. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 2. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 1. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 2. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 1. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 2. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                <tr>
                    <td> 1. </td>
                    <td> Maki </td>
                    <td> 222 </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>