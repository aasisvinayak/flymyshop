<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">

            <a href="/" class="navbar-brand">Shop</a>
        </div>

        <div class="navbar-collapse collapse" id="navbar">

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Formal Wear <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Suits</li>
                        <li><a href="#">Slim</a></li>
                        <li><a href="#">Classic</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Trousers</li>
                        <li><a href="#">Black</a></li>
                        <li><a href="#">Blue</a></li>
                    </ul>
                </li>

                <li><a href="/contact">Contact</a></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>

                    @if (Auth::check())
                        <a href="/login" class="fa fa-cog">Login</a>
                    @else
                        <a href="/account" class="fa fa-cog">My Account</a>
                    @endif

                </li>
            </ul>

        </div>
    </div>
</nav>


<div class="jumbotron text-center">
    <h1>Welcome</h1>
</div>