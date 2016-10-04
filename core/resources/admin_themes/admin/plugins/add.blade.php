@extends('admin-layouts.admin')
@section('title')
    Add a plugin
@stop

@section('content')


    <div class="col-md-8" style="width: @parent">


    <h2>Add a new plugin to FlyMyShop</h2>

        <div class="alert alert-warning">
            You can add any plugin provided it has met all the requirements to be a
            Flymyshop plugin
        </div>


        @include('admin-partials._form-error')

    {{Form::open(array('action' =>"PluginController@processAddPlugin"))}}

    <div class="form-group">
        {{Form::label('url',"Enter GitHub Plugin Project URL")}}
        {{Form::text('url',old('url'),array('class'=>'form-control', 'placeholder'=>'https://github.com/aasisvinayak/fms_promo_code_plugin'))}}
    </div>

    <div class="form-group">
    {{Form::submit("Add Plugin", array('class'=>'form-control'))}}
    </div>


    {{Form::close()}}

    </div>

@stop