@extends('admin-layouts.admin')
@section('title')
    Sales Report
@stop

@section('content')

    <style>
        .shop_tab {
            border: 1px solid #ccc;
            padding: 5px;
            margin: 5% 0;
            box-shadow: 3px 3px 2px #ccc;
            transition: 0.5s;
        }

        .shop_tab:hover {
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
        }
    </style>

    <div class="container">
        <div class="row col-md-8  custyle">
            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Refund</th>
                    <th>Currency</th>
                    <th>Customer</th>
                    <th>Card (last 4 digits)</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($charges as $item)
                    <tr>
                        <td>{{$item->object}}</td>
                        <td>{{$item->amount/100}}</td>
                        <td>{{$item->created}}</td>
                        <td>{{($item->amount_refunded)/100}}</td>
                        <td>{{$item->currency}}</td>
                        <td>{{$item->customer}}</td>
                        <td>{{$item->last4}}</td>
                        <td>{{$item->status}}</td>
                        <td class="text-center">

                            <?php

                            if($item->amount_refunded == 0){

                            ?>

                            {{Form::open(array('action'=>"AdminController@processRefund"))}}

                            <input type="hidden" value="{{$item->id}}" name="charge_id">

                            <br> <br>
                            {{Form::submit('Refund', array('class' =>" btn-primary  btn-sm"))}}

                            {{Form::close()}}

                            <?php

                            } else {
                                echo " <span style='color: red;'>Refunded</span>";
                            }
                            ?>

                        </td>
                    </tr>

                @endforeach

            </table>
        </div>
    </div>




@stop