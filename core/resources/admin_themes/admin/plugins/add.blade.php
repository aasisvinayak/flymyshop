@extends('admin-layouts.admin')
@section('title')
    Add a plugin
@stop

@section('content')


    <div class="col-md-8" style="width: @parent">


    <h2>Add a new plugin to FlyMyShop</h2>

    {{Form::open(array('action' =>"PluginController@processAddPlugin"))}}

    <div class="form-group">
        {{Form::label('url',"Enter GitHub URL")}}
        {{Form::text('url',old('url'),array('class'=>'form-control'))}}
    </div>

    <div class="form-group">
    {{Form::submit("Add Plugin", array('class'=>'form-control'))}}
    </div>


    {{Form::close()}}

    </div>

@stop