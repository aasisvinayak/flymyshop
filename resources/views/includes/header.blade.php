<?php

use Gloudemans\Shoppingcart\Facades\Cart;

?>

<div class="flash-alerts">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
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

            <ul style="width: 50%; margin-top: 1%" class="nav navbar-nav">
                <script>
                    $(document).ready(function (e) {
                        $('.search-panel .dropdown-menu').find('a').click(function (e) {
                            e.preventDefault();
                            var query = $(this).attr("href").replace("#", "");
                            var filter = $(this).text();
                            $('.search-panel span#search-filter').text(filter);
                            $('.input-group #search_query').val(query);
                        });
                    });
                </script>

                <li>
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span id="search-filter">Filter</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#category1">All</a></li>
                                <li><a href="#category1">Category 1</a></li>
                                <li><a href="#category2">Category 2</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="search_query" value="all" id="search_query">
                        <input type="text" class="form-control" name="x" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">


                <li>

                    @if (Auth::guest())
                        <a href="/login" class="fa fa-cog"> Login</a>
                    @else
                        <a href="/account" class="fa fa-cog">My Account</a>
                    @endif

                </li>


                <li>
                    <a  href="/shop/cart">
                     <span class="fa-stack fa-1x">
                  <i class="fa fa-shopping-cart"></i>
                  <strong class="fa-stack-1x"> &nbsp; <sup>{{Cart::count()}}</sup> </strong>
                </span>
                        Cart</a>
                </li>
            </ul>

        </div>
    </div>
</nav>


