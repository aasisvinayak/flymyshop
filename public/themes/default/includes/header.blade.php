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
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#shop-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Shop</a>
        </div>

        <div class="navbar-collapse collapse" id="shop-navbar">

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Explore <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @foreach($CategoryMenu->all() as $item)
                            <?php
                            //TODO Clean and access items directly
                            $ar=(array)$item->link;
                            $ar2=(array_shift($ar));
                            ?>

                            <li><a href="/listing/{{$ar2['url']}}">{{$item->title}}</a></li>
                        @endforeach

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
                        {{--<div class="input-group-btn search-panel">--}}

                            {{--TODO:Enable search by category--}}

                            {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">--}}
                                {{--<span id="search-filter">Filter</span> <span class="caret"></span>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="#category1">All</a></li>--}}
                                {{--<li><a href="#category1">Category 1</a></li>--}}
                                {{--<li><a href="#category2">Category 2</a></li>--}}
                            {{--</ul>--}}

                        {{--</div>--}}


                        {{Form::open(array('action'=>'ShopController@search'))}}
                        <input type="hidden" name="search_query" value="all" id="search_query">
                        <input type="text" class="form-control" name="q" placeholder="Search">
                <span style="display: inherit" class="input-group-btn">


                    {{Form::button('<span class="glyphicon glyphicon-search"></span>', array('type' => 'submit', 'class' => 'btn btn-default sbutton', 'id'=>'searchButton'))}}
                    {{Form::close()}}


                </span>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money"></i>  <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/shop/currency/USD">$</a> </li>
                            <li><a href="/shop/currency/GBP">£</a> </li>
                            <li><a href="/shop/currency/EUR">€</a></li>
                        </ul>
                    </li>
                    <li><a href="/contact">Contact</a></li>



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


