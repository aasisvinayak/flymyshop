@extends('layouts.admin')
@section('title')
    Sales Report
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
            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Order No</th>
                    <th>Date </th>
                    <th>Amount</th>
                    <th>Tax</th>
                    <th>Shipping </th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($orders as $item)
                    <tr>
                        <td>{{$item->order_no}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->sub_total}}</td>
                        <td>{{$item->tax}}</td>
                        <td>{{$item->shipping}}</td>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->last4}}</td>
                        <td>{{$item->status}}</td>
                        <td class="text-center">

                        </td>
                    </tr>

                @endforeach

            </table>



        </div>
    </div>

    {{ $orders->links() }}


@stop