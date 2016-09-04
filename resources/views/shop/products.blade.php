@extends('layouts.main')
@section('content')

    <style>
        .btn-product{
            width: 100%;
        }
    </style>

    <div class="jumbotron text-center">
        <h1>Category 1</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">


                    @foreach ($products as $product)


                    <a href="/shop/product/{{$product->product_id}}">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" >
                        <h4 class="text-center"><span class="label label-info">Category 1</span></h4>
                        <img src="http://placehold.it/650x450&text=Image 1" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h3>{{$product->title}}  </h3>
                                </div>
                                <div class="col-md-6 col-xs-6 price">
                                    <h3>
                                        <label>{{$product->price}} </label></h3>
                                </div>
                            </div>
                            <p>{{$product->description}} </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-primary btn-product"><span class="glyphicon glyphicon-heart"></span> Favourite</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-success btn-product"><span class="glyphicon glyphicon-shopping-cart"></span> Buy</a></div>
                            </div>

                            <p> </p>
                        </div>
                    </div>
                </div>

                    </a>



                        @endforeach



            </div>

            {{ $products->links() }}

        </div>
    </div>


@stop