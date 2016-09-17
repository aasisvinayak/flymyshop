<div class="col-md-12">


    @foreach ($products as $product)


        <a href="/shop/product/{{$product->product_id}}">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" >
                    <h4 class="text-center"><span class="label label-info">{{$product->make}}</span></h4>

                    @if(!($product->image_name=="" || $product->image_name=="sample_file_123.png"))

                        <img style="height: 250px" src="/uploads/{{$product->image_name}}" class="img-responsive">

                    @else

                        <img src="http://placehold.it/650x450&text=Image Not Uploaded"
                             class="img-responsive">
                    @endif

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

                                {{Form::open(array('action' => "ShopController@addFavourite"))}}

                                <input type="hidden" name="product-id" value="{{$product->product_id}}">

                                {{--<span class="glyphicon glyphicon-heart"></span>--}}
                                {{Form::submit(' Favourite', array("class" =>"btn btn-primary btn-product") )}}
                                <input type="hidden" name="product_id" value="{{$product->product_id}}">

                                {{Form::close()}}

                            </div>
                            <div class="col-md-6">
                                {{Form::open(array('action' => "ShopController@addCart"))}}

                                <input type="hidden" name="product_id" value="{{$product->product_id}}">

                                {{--<span class="glyphicon glyphicon-shopping-cart"></span>--}}
                                {{Form::submit('  Buy', array("class" =>"btn btn-success btn-product") )}}

                                {{Form::close()}}

                            </div>
                        </div>

                        <p> </p>
                    </div>
                </div>
            </div>

        </a>



    @endforeach



</div>
