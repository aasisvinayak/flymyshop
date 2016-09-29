@extends('layouts.main')
@section('content')


    <style>

        .gold {
            color: #FFDF00;
        }

        .product {
            border: 1px solid #dddddd;
            height: 330px;
        }

        .product-title {
            font-size: 20px;
        }

        .product-desc {
            font-size: 15px;
        }

        .product-price {
            font-size: 24px;
        }

        .product-rating {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .product-stock {
            color: #42FF00;
            font-size: 20px;
            margin-top: 10px;
        }
        
        .display-items {
            padding: 0px 0 0px 0;
            float: left;
            position: relative;
            overflow: hidden;
            max-width: 100%;
            height: 350px;
            width: 150px;
        }

        .display-item {
            height: 110px;
            width: 125px;
            display: block;
            float: left;
            position: relative;
            padding-right: 25px;
            border-right: 1px solid #DDD;
            border-top: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
        }

        .display-item > img {
            max-height: 120px;
            max-width: 120px;
            opacity: 0.75;
            transition: all .2s ease-in;
            -o-transition: all .2s ease-in;
            -moz-transition: all .2s ease-in;
            -webkit-transition: all .2s ease-in;
        }

        .display-item > img:hover {
            cursor: pointer;
            opacity: 1;
        }

        .display-image-left > center > img, .display-image-right > center > img {
            max-height: 175px;
        }

    </style>

    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="item-container">
                <div class="container">
                    <div class="col-md-12">

                        <div class="col-md-6">
                            <div class="product col-md-3 service-image-left">

                                @if(!($product->image_name=="" || $product->image_name=="sample_file_123.png"))

                                    <img style="width: 100%" id="item-display" src="/uploads/{{$product->image_name}}" alt=""></img>

                                @else

                                    <img src="http://placehold.it/650x450&text=Image Not Uploaded"
                                         class="img-responsive">
                                @endif

                            </div>







                            <div class="container display-items col-sm-2 col-md-2 pull-left">
                                <center>

                                    <?php $i=0; ?>
                                    @foreach($productAdditionalImages as $image)
                                            <?php $i++; ?>
                                        <a id="item-{{$i}}" class="display-item">
                                            <img src="/uploads/{{$image['image_name']}}" alt=""></img>
                                        </a>
                                    @endforeach

                                </center>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="product-title"> {{$product->title}}  </div>
                            <div class="product-desc">{{$product->description}}</div>

                            {{--TODO Add product rating facility--}}

                            {{--<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i>--}}
                                {{--<i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i--}}
                                        {{--class="fa fa-star-o"></i>--}}
                            {{--</div>--}}
                            <hr>
                            <div class="product-price">{{$product->price}}</div>

                            @if($product->stock>0)

                            <div class="product-stock">In Stock</div>
                            <hr>
                            <div class="btn-group cart">

                                {{Form::open(array('action' => "ShopController@addCart"))}}

                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                {{--<span class="glyphicon glyphicon-shopping-cart"></span>--}}
                                {{Form::submit('Buy', array("class" =>"btn btn-success btn-product") )}}

                                {{Form::close()}}
                            </div>
                            <div class="btn-group wishlist">
                                {{Form::open(array('action' => "ShopController@addFavourite"))}}

                                <input type="hidden" name="product-id" value="{{$product->product_id}}">

                                {{--<span class="glyphicon glyphicon-heart"></span>--}}
                                {{Form::submit('Favourite', array("class" =>"btn btn-primary btn-product") )}}
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">

                                {{Form::close()}}
                            </div>


                            @else

                                <div style="color: red;" class="product-stock">Not In Stock</div>
                                <hr>

                            @endif

                        </div>


                    </div>


                </div>
            </div>

            <div class="container-fluid" style="margin-top:5% ">
                <div class="col-md-12 product-info">
                    <ul id="myTab" class="nav nav-tabs nav_tabs">

                        <li class="active"><a href="#service-one" data-toggle="tab">DETAILS</a></li>
                        {{--<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>--}}

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="service-one">

                            <section class="container product-info">

                                {{$product->details}}

                            </section>

                        </div>
                        <div class="tab-pane fade" id="service-two">

                            <section class="container">

                                {{--TODO add reviews--}}

                            </section>

                        </div>

                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

@stop