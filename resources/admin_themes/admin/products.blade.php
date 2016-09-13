@extends('admin-layouts.admin')
@section('title')
    Products
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

<div class="container">
    <div class="row col-md-8  custyle">

        <span style="float: right">
            <a class='btn btn-info btn' href="/admin/products/create ">
                <span class="glyphicon glyphicon-edit"></span> Add New Product</a>
        </span>


        <table class="table table-striped shop_tab">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description </th>
                <th class="text-center">Action</th>
            </tr>
            </thead>


            @foreach($products as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->description}}</td>
                    <td class="text-center">
                        <a class='btn btn-info btn-xs' href="/shop/product/{{$item->product_id}} ">
                            <span class="glyphicon glyphicon-edit"></span> View</a>
                        <a class='btn btn-info btn-xs' href="/admin/products/{{$item->id}}/edit ">
                            <span class="glyphicon glyphicon-edit"></span> Edit</a>
                    </td>
                </tr>

            @endforeach

        </table>
    </div>
</div>


{{ $products->links() }}


@stop