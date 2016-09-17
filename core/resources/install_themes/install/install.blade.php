@extends('install-layouts.layout')
@section('content')

<h1>Welcome to FlyMyShop Installation Wizard</h1>

<br>
    <p>
        Please complete the following details to install the shop.
    </p>

    {{Form::open(array('action'=>'InstallController@installShop'))}}
    {{Form::label('SHOP_NAME','Name of the shop')}}
    {{Form::text('SHOP_NAME',old('SHOP_NAME'),array('class'=>'form-control'))}}
    {{Form::label('DB_HOST','Database host')}}
    {{Form::text('DB_HOST',old('DB_HOST'),array('class'=>'form-control'))}}
    {{Form::label('DB_PORT','Database port')}}
    {{Form::text('DB_PORT',old('DB_PORT'),array('class'=>'form-control'))}}
    {{Form::label('DB_USERNAME','Database username')}}
    {{Form::text('DB_USERNAME',old('DB_USERNAME'),array('class'=>'form-control'))}}
    {{Form::label('DB_PASSWORD','Database password')}}
    {{Form::password('DB_PASSWORD',array('class'=>'form-control'))}}
    {{Form::label('DB_DATABASE','Database name')}}
    {{Form::text('DB_DATABASE',old('DB_DATABASE'),array('class'=>'form-control'))}}

<br> <br>
    {{Form::submit('Install',array('class' => 'btn btn-primary'))}}

<br> <br>

    {{Form::close()}}

@stop
