@extends('layouts.main')
@section('content')


    @include('partials._form-error')

    {{Form::open(array('action'=>'ProductController@store', 'files' => true))}}

    @include('partials._product-form',array('productButton'=>'Add Product'))

    {{Form::close()}}


    @stop
