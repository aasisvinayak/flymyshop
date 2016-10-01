@extends('layouts.lmain')
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
                    <th>Order Number</th>
                    <th>Invoice Date</th>
                    <th>Total </th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>


                <?php $i=0; ?>
                @foreach($invoices as $item)

                    <?php $i++ ?>
                <tr>
                    <td>{{$item->order_no}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->sub_total}}</td>
                    <td class="text-center">
                        <a id="view-invoice-{{$i}}" class='btn btn-info btn-xs' href="/account/orders/{{$item->invoice_id}} ">
                            <span class="glyphicon glyphicon-edit"></span> View</a>
                       </td>
                </tr>

                    @endforeach

            </table>
        </div>
    </div>


    {{ $invoices->links() }}

@stop