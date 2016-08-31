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
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg"
                     class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    Marcus Doe
                </div>
                <div class="profile-usertitle-job">
                    Developer
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="btn btn-success btn-sm">Follow</button>
                <button type="button" class="btn btn-danger btn-sm">Message</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="nav">
                    <li class="active">
                        <a href="#">
                            <i class="glyphicon glyphicon-home"></i>
                            Overview </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-user"></i>
                            Account Settings </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="glyphicon glyphicon-ok"></i>
                            Tasks </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-flag"></i>
                            Help </a>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
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