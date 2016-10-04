@extends('admin-layouts.admin')
@section('title')
    Plugin List
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