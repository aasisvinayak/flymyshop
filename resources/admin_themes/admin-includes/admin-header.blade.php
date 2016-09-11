<div class="flash-alerts">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>

{{--TODO move css to sheet--}}

<style>
    .panel-body .btn:not(.btn-block) {
        width: 150px;
        margin-bottom: 12px;
    }

    @media (min-width: 768px) {
        nav.sidebar  nav.sidebar .navbar-header{
            text-align: center;
            width: 100%;
            margin-left: 0px;
        }

        nav.sidebar .navbar-nav .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
        }

        nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{
            padding: 0 0px 0 0px;
        }

        nav.sidebar{
            width: 200px;
            height: 100%;
            margin-left: -150px;
            float: left;
            z-index: 10000;
            margin-bottom: 0px;
        }

        nav.sidebar li {
            width: 100%;
        }
    }

    @media (min-width: 1330px) {
        nav.sidebar{
            margin-left: 0px;
            float: left;
        }
    }

    nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
        background-color: transparent;
    }


</style>


<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
               Admin MENU
            </button>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <h1> <a class="shop-name" href="#">
                    Shop Administrator
                </a></h1>

        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/" target="_blank">View Shop</a></li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Account
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">SETTINGS</li>

                        {{--TODO--}}
                        {{--<li class=""><a href="#">Notifications</a></li>--}}
                        {{--<li class=""><a href="#">Alerts</a></li>--}}
                        <li class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>



