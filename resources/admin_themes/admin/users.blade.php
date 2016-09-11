@extends('admin-layouts.admin')
@section('title')
    Users
@stop

@section('content')

    <style>
        .custab{
            border: 1px solid #ccc;
            padding: 5px;
            margin: 5% 0;
            box-shadow: 3px 3px 2px #ccc;
            transition: 0.5s;
        }
        .custab:hover{
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
        }
    </style>

    <div class="container">
        <div class="row col-md-8  custyle">


            <table class="table table-striped custab">
                <thead>
                <tr>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>


                @foreach($users as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->status}}</td>
                        <td class="text-center">
                            <a class='btn btn-danger btn-xs' href=" ">
                                <span class="glyphicon glyphicon-edit"></span> Diable User </a>
                        </td>
                    </tr>

                @endforeach

            </table>
        </div>
    </div>


    {{ $users->links() }}


@stop