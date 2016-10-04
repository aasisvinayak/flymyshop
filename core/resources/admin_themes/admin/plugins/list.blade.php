@extends('admin-layouts.admin')
@section('title')
    Plugin List         <a style="float: right;" class="btn btn-success btn-lg" href="/admin/add_plugin">Add Plugin</a>
    <br> <br>
@stop

@section('content')


    <div id="plugins">


        <ul>
            @foreach(fms_plugins() as $plugin)
                <li>{{$plugin}}</li>
            @endforeach

        </ul>
    </div>
@stop