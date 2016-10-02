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
        <div class="row col-md-6 custyle">
            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Order No</th>
                    <th>Date </th>
                    <th>Amount</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>View</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                <?php $i=0; ?>
                @foreach($orders as $item)
                    <?php $i++; ?>
                    <tr>
                        <td>{{$item->order_no}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->sub_total}}</td>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->status}}</td>
                        <td><a id="view-order-{{$i}}" class="btn btn-primary" href="/admin/orders/{{$item->id}}">View Order</a></td>
                        <td class="text-center">
                            {{Form::open(array('action'=>"AdminController@updateOrderStatus"))}}

                            <input id="update-order-status-{{$i}}" type="hidden" name="id" value="{{$item->id}}">
                            {{ Form::select('status', [
                                           '1' => 'Currently being processed!',
                                           '2' => 'At Warehouse',
                                           '3' => 'Dispatched',
                                           '4' => 'Cancelled & Refund Pending',
                                           '5' => 'Cancelled & Refund Issued',
                                           ]
                                            ) }}

                            <br> <br>
                            {{Form::submit('Update', array('class' =>" btn-primary  btn-sm"))}}

                            {{Form::close()}}

                        </td>
                    </tr>

                @endforeach

            </table>



        </div>
    </div>

    {{ $orders->links() }}


@stop