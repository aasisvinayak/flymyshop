@extends('layouts.lmain')
@section('content')

    <style>

        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-xs-8">
                <div class="invoice-title">
                    <h2>Invoice</h2><h3 class="pull-right">Order # {{$order_no}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Card<br>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            {{$invoice_date}}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Product</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Units</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($products as $product)

                                    <tr>
                                        <td>{{$product->title}}</td>
                                        <td class="text-center">{{$product->price}}</td>
                                        <td class="text-center">{{$product->qty}}</td>
                                        <td class="text-right">{{filter_var($product->price, FILTER_SANITIZE_NUMBER_FLOAT,
                    FILTER_FLAG_ALLOW_FRACTION) *$product->qty}}</td>
                                    </tr>

                                    @endforeach

                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">{{$sub_total}}</td>
                                    </tr>

                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Shipping & Tax</strong></td>
                                        <td class="no-line text-right">{{$tax+$shipping}}</td>
                                    </tr>

                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">{{$sub_total+$tax+$shipping}}</td>
                                    </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>


@stop