@extends('admin-layouts.admin')
@section('title')
    Plugins List         <a style="float: right;" class="btn btn-success btn-lg" href="/admin/add_plugin">Add Plugin</a>
    <br> <br>
@stop

@section('content')


    <div id="plugins">


        <ul>
            @foreach($plugins as $plugin)
                <li>{{$plugin->name}}</li>
            @endforeach

        </ul>

        {{ $plugins->links() }}
    </div>
@stop