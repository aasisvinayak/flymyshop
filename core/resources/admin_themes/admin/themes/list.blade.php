@extends('admin-layouts.admin')
@section('title')
    Themes List         <a style="float: right;" class="btn btn-success btn-lg" href="/admin/add_theme">Add Theme</a>
    <br> <br>
@stop

@section('content')


    <div id="themes">


        <ul>
            @foreach(fms_themes() as $theme)
                <li>{{$theme}}</li>
            @endforeach

        </ul>
    </div>
@stop