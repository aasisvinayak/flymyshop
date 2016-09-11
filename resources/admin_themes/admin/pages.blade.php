@extends('layouts.admin')
@section('title')
    Categories
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
            <a class='btn btn-info btn' href="/admin/pages/create ">
                <span class="glyphicon glyphicon-edit"></span>  New Page</a>
        </span>


            <table class="table table-striped shop_tab">
                <thead>
                <tr>
                    <th>Page Name</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>


                @foreach($pages as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="/admin/pages/{{$item->id}} ">
                                <span class="glyphicon glyphicon-edit"></span> View  </a>
                            <a class='btn btn-warning btn-xs' href="/admin/pages/{{$item->id}}/edit ">
                                <span class="glyphicon glyphicon-edit"></span> Edit</a>

                            {{ Form::open(array('url' => '/admin/pages/' . $item->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>

                @endforeach

            </table>
        </div>
    </div>


    {{ $pages->links() }}


@stop