@extends('layouts.lmain')
@section('content')

    <h1>Edit Address</h1>

@include('partials._form-error')
    {{ Form::model($address, array('action' => array('AddressController@update', $address->address_id), 'method' => 'PUT')) }}


    @include('partials._address-form',array("buttonName"=>"Update Address"))


    {{ Form::close() }}

    <br>


    @stop
