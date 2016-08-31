<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

    <header class="row">
        @include('includes.header')
    </header>


    <div class="col-md-3">
        <div class="profile-sidebar">

            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    {{--{{Auth::user()->email }}--}}
                </div>
                <div class="profile-usertitle-job">
                    Welcome
                </div>
            </div>

            <div class="profile-usermenu">
                <ul class="nav">
                    <li class="active">
                        <a href="/user/payment">
                            <i class="glyphicon glyphicon-home"></i>
                            Payment Information </a>
                    </li>
                    <li>
                        <a href="/user/address">
                            <i class="glyphicon glyphicon-user"></i>
                            Address Book </a>
                    </li>
                    <li>
                        <a href="/user/order_history">
                            <i class="glyphicon glyphicon-ok"></i>
                            Order History </a>
                    </li>
                    <li>
                        <a href="/user/setttings">
                            <i class="glyphicon glyphicon-ok"></i>
                            Settings </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">

        <div id="main" class="row">

            @yield('content')

        </div>
    </div>

    <footer class="row">
        @include('includes.footer')
    </footer>

</div>
</body>
</html>