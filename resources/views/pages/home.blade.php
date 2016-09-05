@extends('layouts.main')
@section('content')

    <style>
        .btn-product{
            width: 100%;
        }
    </style>

    <div class="jumbotron text-center">
        <h1>Welcome to Laravel Shop</h1>
    </div>

    <div class="container">
        <div class="row">


            <div class="col-md-12">


            <?php

            $counter=0;


            ?>



        @foreach($products as $product)


                    <?php

                   

                        if($counter==0){
                            echo "<div class='col-md-12'>";
                        }


                    ?>




                        <a href="/shop/product/{{$product->product_id}}">

                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" >
                        <h4 class="text-center"><span class="label label-info">Featured</span></h4>
                        <img style="height: 250px" src="/uploads/{{$product->image_name}}" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h3>{{$product->title}}</h3>
                                </div>
                                <div class="col-md-6 col-xs-6 price">
                                    <h3>
                                        <label>{{$product->price}}</label></h3>
                                </div>
                            </div>
                            <p>{{$product->description}}</p>

                        </a>
                            <div class="row">
                                <div class="col-md-6">

                                    {{Form::open(array('action' => "StoreController@addFavourite"))}}

                                    <input type="hidden" name="product-id" value="{{$product->product_id}}">

                                    {{--<span class="glyphicon glyphicon-heart"></span>--}}
                                    {{Form::submit(' Favourite', array("class" =>"btn btn-primary btn-product") )}}
                                    <input type="hidden" name="product_id" value="{{$product->product_id}}">

                                    {{Form::close()}}

                                </div>
                                <div class="col-md-6">

                                {{Form::open(array('action' => "StoreController@addCart"))}}

                                    <input type="hidden" name="product_id" value="{{$product->product_id}}">

                                    {{--<span class="glyphicon glyphicon-shopping-cart"></span>--}}
                                {{Form::submit('  Buy', array("class" =>"btn btn-success btn-product") )}}

                                {{Form::close()}}
                            </div>

                            <p> </p>
                        </div>
                    </div>
                </div>



                        <?php


                        if($counter==2){
                            echo "</div>";
                            $counter=0;
                        }

                        $counter++;

                        ?>

            @endforeach



        </div>
    </div>


@stop