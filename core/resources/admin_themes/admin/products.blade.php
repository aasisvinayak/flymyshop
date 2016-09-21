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
                <th>Status </th>
                <th class="text-center">Action</th>
                <th class="text-center">Update Status</th>
            </tr>

            </thead>


            <?php $i=0 ?>

            @foreach($products as $item)
                <?php $i++ ?>
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->status}}</td>
                    <td class="text-center">
                        <a class='btn btn-info btn-xs' href="/admin/products/{{$item->id}}/ ">
                            <span class="glyphicon glyphicon-edit"></span> View</a>
                        <a class='btn btn-info btn-xs' href="/admin/products/{{$item->id}}/edit ">
                            <span class="glyphicon glyphicon-edit"></span> Edit</a>
                    </td>

                    <td class="text-center">
                        {{Form::open(array('action'=>"ProductController@updateProductStatus"))}}

                        <input type="hidden" name="id" value="{{$item->id}}">
                        {{ Form::select('status', [
                                       '1' => 'Publish',
                                       '0' => 'Un-publish'
                                       ], null, array('id'=>'selectStatus'.$i)
                                        ) }}

                        <br> <br>
                        {{Form::submit('Update', array('class' =>" btn-primary  btn-sm", 'id'=> 'updateButton'.$i))}}

                        {{Form::close()}}

                    </td>
                </tr>

            @endforeach

        </table>
    </div>
</div>


{{ $products->links() }}


@stop