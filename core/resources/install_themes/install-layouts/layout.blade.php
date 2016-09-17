<!doctype html>
<html>
<head>
    @include('install-includes.head')
</head>
<body>
<div class="container">

    <header>
        @include('install-includes.header')
    </header>

    <div class="container-fluid main-container">
        <div class="col-md-10 content">
            @yield('content')
        </div>

    </div>

    <footer class="row">


    </footer>

</div>
</body>
</html>