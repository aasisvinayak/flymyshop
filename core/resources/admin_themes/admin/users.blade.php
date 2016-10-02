@extends('admin-layouts.admin')
@section('title')
    Users
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
                    <th> Name</th>
                    <th> Email</th>
                    <th> Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                <?php $i=0; ?>
                @foreach($users as $item)
                    <?php $i++; ?>
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->status}}</td>
                        <td class="text-center">

                            {{Form::open(array('action'=>"AdminController@updateUserStatus"))}}

                            <input id="update-user-status-{{$i}}" type="hidden" name="id" value="{{$item->id}}">
                            {{ Form::select('status', [
                                           '1' => 'Enable User',
                                           '0' => 'Disable User',
                                           ]
                                            ) }}

                            <br> <br>
                            {{Form::submit('Update', array('class' =>" btn-primary  btn-sm", "id" =>"update-user-status-btn-".$i ))}}

                            {{Form::close()}}
                        </td>
                    </tr>

                @endforeach

            </table>
        </div>
    </div>


    {{ $users->links() }}


@stop