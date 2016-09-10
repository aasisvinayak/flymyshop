@extends('layouts.lmain')
@section('content')



    <h1>Add Address</h1>


    @include('partials._form-error')

    {{ Form::open(array('action' => 'AddressController@store')) }}

    @if (session('next-page'))

        <input type="hidden" name="next_page" value="{{session('next-page')}}">

    @endif


    @include('partials._address-form',array("buttonName"=>"Add Address"))


    {{ Form::close() }}


    <br>


@stop
