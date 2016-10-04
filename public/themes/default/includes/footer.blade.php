<?php

use Carbon\Carbon;

$now = Carbon::now();
$now = $now->year;

?>

<style>
    .footer {
        background-color: #000000;
        padding: 30px 30px;
        color: rgba(255, 255, 255, 1.00);
        margin-bottom: 25px;
    }

    .footer .footer-shop-name, .footer .footer-menu, .footer .footer-sm, .footer .footer-nl {
        padding: 10px 25px;
    }

    .footer .footer-menu, .footer .footer-sm, .footer .footer-nl {
        border-color: transparent;
    }

    .footer .footer-shop-name h2 {
        margin: 0px 0px 10px;
    }

    .footer .footer-shop-name p {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.70);
    }

    .footer .footer-menu ul.categories {
        list-style: none;
        padding: 0px;
    }

    .footer .footer-menu ul.categories li {
        padding: 5px 0px;
    }

    .footer .footer-menu ul.categories a {
        color: rgba(255, 255, 255, 1.00);
        font-weight: bold;
        text-transform: uppercase;
    }

    .footer .footer-menu h4 {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 12px;
    }

    .footer .footer-menu ul.page {
        list-style: none;
        padding: 0px;
    }

    .footer .footer-menu ul.page li {
        padding: 5px 0px;
    }

    .footer .footer-menu ul.page a {
        color: rgba(255, 255, 255, 1.00);
    }

    .footer .footer-sm ul {
        list-style: none;
        padding: 0px;
    }

    .footer .footer-sm h4 {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 4px;
    }

    .footer .footer-sm li {
        padding: 5px 4px;
    }

    .footer .footer-sm a {
        color: rgba(255, 255, 255, 1.00);
    }

    .footer .footer-nl h4 {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 12px;
    }

    .footer .footer-nl p {
        font-size: 12px;
        color: rgba(255, 255, 255, 1.00);
    }

    @media (min-width: 800px) {
        .footer .footer-menu, .footer .footer-sm, .footer .footer-nl {
            border-left: solid 1px rgba(255, 255, 255, 0.30);
        }
    }
</style>

<div class="container">
    <section style="height:80px;"></section>
    <div class="row">
    </div>
    <footer class="footer">
        <div class="row">
            <div class="col-md-3 footer-shop-name">
                <h2>{{config('flymyshop.shopName')}}</h2>


                <p>© {{$now}} GPLv3 Fly My Cloud Limited</p>
            </div>
            <div class="col-md-4 footer-menu">
                <h4>Shop</h4>
                <div class="col-md-6">
                    <ul class="categories">

                        @foreach($CategoryMenu->all() as $item)
                            <?php
                            //TODO Clean and access items directly
                            $ar=(array)$item->link;
                            $ar2=(array_shift($ar));
                            ?>

                            <li><a href="/listing/{{$ar2['url']}}">{{$item->title}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="page">
                    @foreach($PageMenu->all() as $item)
                            <?php
                                //TODO Clean and access items directly
                            $ar=(array)$item->link;
                            $ar2=(array_shift($ar));
                            ?>

                        <li><a href="/pages/{{$ar2['url']}}">{{$item->title}}</a></li>
                    @endforeach


                    </ul>
                </div>
            </div>
            <div class="col-md-2 footer-sm">
                <h4>Social Media</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Google+</a></li>
                    <li><a href="#">RSS feed</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-nl">
                <h4>Newsletter</h4>
                <p>Subscribe to our newsletter!</p>
                <p>
                <div class="input-group">

                    {{Form::open(array("action"=>"ShopController@newsletter"))}}
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                      <span style="display: initial" class="input-group-btn">
                        {{Form::submit('Join',array('class'=>"form-control"))}}
                      </span>

                    {{Form::close()}}
                </div>
                </p>
            </div>
        </div>
    </footer>
    <section style="text-align:center; margin:10px auto;"><p>A product from <a href="https://www.flymycloud.com">Fly My
                Cloud Limited</a></p></section>

</div>

<?php //var_dump(categories());?>