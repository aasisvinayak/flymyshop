@extends('admin-layouts.admin')
@section('title')
    Orders
@stop

@section('content')

    <style>
        .shop_tab{
            border: 1px solid #ccc;
            padding: 5px;
            margin: 5% 0;
            box-shadow: 3px 3px 2px #ccc;
            transition: 0.5s;
        }
        .shop_tab:hover{
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
        }
    </style>

    <div class="">
        <div class="row col-md-9 custyle">
            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>View</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($products as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->stock}}</td>
                        <td>{{$item->status}}</td>
                        <td><a class="btn btn-primary" href="/admin/shop/product/{{$item->product_id}}">View Product</a></td>
                        <td class="text-center">
                            {{Form::open(array('action'=>"ProductController@updateStock"))}}

                            <input type="hidden" name="id" value="{{$item->id}}">
                            {{ Form::number('stock',old('stock'),array('class' =>'form-control') ) }}

                            <br> <br>
                            {{Form::submit('Update', array('class' =>" btn-primary  btn-sm"))}}

                            {{Form::close()}}

                        </td>
                    </tr>

                @endforeach

            </table>
            {{ $products->links() }}



        </div>

    </div>



@stop