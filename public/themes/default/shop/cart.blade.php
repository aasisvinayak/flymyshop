
@extends('layouts.main')
@section('content')


    <style>

        .table>tbody>tr>td, .table>tfoot>tr>td{
            vertical-align: middle;
        }
        @media screen and (max-width: 600px) {
            table#cart tbody td .form-control{
                width:20%;
                display: inline !important;
            }
            .actions .btn{
                width:36%;
                margin:1.5em 0;
            }

            .actions .btn-info{
                float:left;
            }
            .actions .btn-danger{
                float:right;
            }

            table#cart thead { display: none; }
            table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
            table#cart tbody tr td:first-child { background: #333; color: #fff; }
            table#cart tbody td:before {
                content: attr(data-th); font-weight: bold;
                display: inline-block; width: 8rem;
            }



            table#cart tfoot td{display:block; }
            table#cart tfoot td .btn{display:block;}

        }

    </style>

    <div class="container">






        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>


            <?php $i=0;?>

    @foreach($cart_content as $item)

        <?php $i++;?>
    <tr>
        <td data-th="Product">
            <div class="row">
                <div class="col-sm-2 hidden-xs"><img src="/uploads/{{$item->options->image_name}}" alt="..." class="img-responsive"/></div>
                <div class="col-sm-10">
                    <h4 class="nomargin"><a href="/shop/product/{{$item->id}}">{{$item->name}}</a> </h4>
                    <p>

                        {{$item->options->description}}
                    </p>
                </div>
            </div>
        </td>
        <td data-th="Price">{{$item->options->price}}</td>
        <td data-th="Quantity">

            {{Form::open(array('action' => "ShopController@updateCart", 'name'=>'updateForm'.$i))}}
            <input type="number" name="qty" class="form-control text-center" value="{{$item->qty}}">
            <input type="hidden" name="row_id" value="{{$item->rowId}}">

            <a id="update-btn" class="btn btn-info btn-sm" href="javascript:document.updateForm{{$i}}.submit();"><i class="fa fa-refresh"></i></a>

            <span style="display: none;">            {{Form::button('Update', array("class" =>"btn btn-info btn-sm", 'type'=>'submit') )}}
            </span>

            {{Form::close()}}
        </td>
        <td data-th="Subtotal" class="text-center">{{$item->subtotal}}</td>
        <td class="actions" data-th="">




            {{Form::open(array('action' => "ShopController@removeFromCart",  'name'=>'deleteForm'.$i))}}

            <input type="hidden" name="row_id" value="{{$item->rowId}}">

            <a id="delete-btn" class="btn btn-danger btn-sm" href="javascript:document.deleteForm{{$i}}.submit();"><i class="fa fa-trash-o"></i></a>

            <span style="display: none;">
            {{Form::button('Remove', array("class" =>"btn btn-danger btn-sm", 'type'=>'submit') )}}
            </span>

            {{Form::close()}}
        </td>
    </tr>



    @endforeach







    </tbody>
    <tfoot>
    <tr class="visible-xs">
        <td class="text-center"><strong>Total {{$total_price}}</strong></td>
    </tr>
    <tr>
        <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total {{$total_price}}</strong></td>
        <td><a href="/shop/check_out" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
    </tr>
    </tfoot>
</table>
</div>


@stop
