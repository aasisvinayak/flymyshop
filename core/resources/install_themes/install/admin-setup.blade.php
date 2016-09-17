@extends('install-layouts.layout')

@section('content')


    <h1>Welcome to FlyMyShop Installation Wizard</h1>

    <br>

    <p>
        Please complete the following details to install the shop.

    </p>


    {{Form::open(array('action'=>'InstallController@process'))}}


    {{Form::label('admin_user','Admin username (email)')}}
    {{Form::email('admin_user',old('admin_user'),array('class'=>'form-control'))}}

    {{Form::label('admin_password','Admin password')}}
    {{Form::password('admin_password',array('class'=>'form-control'))}}

    <br> <br>
    {{Form::submit('Save',array('class' => 'btn btn-primary'))}}

    <br> <br>

    {{Form::close()}}

@stop
