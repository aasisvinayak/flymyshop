
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
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>

            <?php $i=0;?>
            @foreach($favourites as $item)
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

                    <td class="actions" data-th="">




                        {{Form::open(array('action' => "ShopController@removeFavourite" , 'name'=>'deleteForm'.$i))}}

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

            <tr>
                <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
            </tr>
            </tfoot>
        </table>
    </div>


@stop
