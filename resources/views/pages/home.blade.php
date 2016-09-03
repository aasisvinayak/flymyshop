@extends('layouts.main')
@section('content')

    <style>
        .btn-product{
            width: 100%;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" >
                        <h4 class="text-center"><span class="label label-info">Category 1</span></h4>
                        <img src="http://placehold.it/650x450&text=Image 1" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h3>Proudct Name</h3>
                                </div>
                                <div class="col-md-6 col-xs-6 price">
                                    <h3>
                                        <label>$100.00</label></h3>
                                </div>
                            </div>
                            <p>Product Description</p>
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
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" >
                        <h4 class="text-center"><span class="label label-info">Category 2</span></h4>
                        <img src="http://placehold.it/650x450&text=Image 2" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h3>Product Name 2</h3>
                                </div>
                                <div class="col-md-6 col-xs-6 price">
                                    <h3>
                                        <label>$99.00</label></h3>
                                </div>
                            </div>
                            <p>Product Description</p>
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
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" >
                        <h4 class="text-center"><span class="label label-info">Category 3</span></h4>
                        <img src="http://placehold.it/650x450&text=Image 3" class="img-responsive">
                        <div class="caption">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <h3>Product Name </h3>
                                </div>
                                <div class="col-md-6 col-xs-6 price">
                                    <h3>
                                        <label>$100.00</label></h3>
                                </div>
                            </div>
                            <p>Product Description </p>
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

            </div>

        </div>
    </div>


@stop